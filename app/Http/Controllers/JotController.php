<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Jot;

class JotController extends Controller
{

    public function sign_in(Request $request)
    {
        dd('login successful.', $request->all());
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
