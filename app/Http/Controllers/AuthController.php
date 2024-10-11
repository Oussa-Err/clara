<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
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

        //Verify user
        event(new Registered($user));

        //Redirect
        return redirect()->route('home');
    }


    // view email notice page
    public function verifyNotice()
    {
        return view('auth.verify-email');
    }

    // Email verification handler
    public function verifyEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect('/dashboard');
    }

    public function verifyNotification(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    }

    public function login(Request $request, Response $response)
    {
        //validate
        $fields = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required'],
        ]);

        //login
        if (!Auth::attempt($fields, $request->remember)) {
            return back()->withErrors(['failed' => 'Invalid credentials']);
        }

        //Redirect
        return redirect()->intended('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
