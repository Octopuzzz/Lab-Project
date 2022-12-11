<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index()
    {
        return view('partials.login', [
            'title' => 'Login',
        ]);
    }
    public function authhenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required|min:5|max:30'
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $request->remember ? true : false)) {
            // The user is being remembered...
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->isAdmin) {
                return redirect()->intended(route('admin'));
            } else {
                return redirect()->intended(route('home'))->with('success', 'Welcome ' . $user->name);
            }
        }
        return back()->with('loginError', 'Login Failed');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('home'))->with('success', 'Logout Success');
    }
}
