<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Jot;
use App\Models\User;

class JotController extends Controller
{

    public function sign_in(Request $request)
    {
        $user_code = $request->code;
        $api_url = env('AUTHX_API_URL');
        $client_id = env('AUTHX_CLIENT_ID');
        $client_secret = env('AUTHX_CLIENT_SECRET');

        $response = Http::post("{$api_url}/oauth/access/token", [
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'redirect_uri' => URL('sign-in'),
            'code' => $user_code,
        ]);

        if(!$response->successful()) {
            $response_body = $response->object();
            return redirect('/')->with('error', "AuthX Error: {$response_body->code} {$response_body->message}");
        }

        $data = $response->object()->data;

        $params = [
            'name' => $data->user->data->first_name.' '.$data->user->data->last_name,
            'password' => Hash::make(Str::random(10)),
            'authx_token' => $data->user->code,
        ];

        $user = User::firstOrCreate(['email' => $data->user->identifier], $params);

        Auth::loginUsingId($user->id);

        return redirect('/')->with('success', 'User successfully logged in.');
    }

    public function home(Request $request)
    {
        $user = $request->user();

        if($user) {
            $jots = Jot::where('user_id', $user->id)->latest()->paginate(12);
        } else {
            $jots = Jot::latest()->paginate(12);
        }

        return view('home', ['jots' => $jots, 'user' => $user, 'title' => 'Home']);
    }

    public function create(Request $request)
    {
        $body = $request->except('_token');
        
        Jot::create($body);

        return redirect('/')->with('success', 'Jot created successfully.');
    }
}
