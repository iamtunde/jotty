<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Jot;
use App\Models\User;

class JotController extends Controller
{

    public function sign_in(Request $request)
    {
        $user_code = $request->code;
        $api_url = env('AUTHX_API_URL');
        $app_code = env('AUTHX_APPLICATION_CODE');

        $response = Http::withHeaders([
            'Api-Token' => env('AUTHX_API_TOKEN'),
        ])->get("{$api_url}/apps/{$app_code}/users/{$user_code}");

        if(!$response->successful())
            return redirect('/')->with('error', 'Unable to complete sign on process at this time, kindly try again in a few seconds.');

        $response_body = $response->json()->data->main_data->data;

        $params = [
            'name' => $response_body->first_name.' '.$response_body->last_name,
            'password' => Hash::make(\Str::rand(111111, 999999)),
            'authx_token' => $user_code,
        ];

        $user = User::firstOrCreate(['email' => $response_body->email], $params);

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
