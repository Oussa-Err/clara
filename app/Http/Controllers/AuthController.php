<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;

class AuthController extends Controller
{
    public function register(Request $request, Response $response)
    {
        //validate
        $fields = $request->validate([
            'username' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['min:8', 'confirmed'],
        ]);

        //Register
        $user = User::create($fields);

        //Login
        Auth::login($user);

        //Redirect
        return redirect()->route('home');
    }


    public function login(Request $request, Response $response)
    {

    }

    public function logout(Request $request)
    {
        $user = User::where('username', '=', $request->usename);
        $user->update(['logged_in' => false]);
    }
}
