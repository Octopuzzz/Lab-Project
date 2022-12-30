<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function kenapaGakBisa()
    {
        try {
            $user = Socialite::driver('google')->user();
            // dd($user, "MAZOK BANG");
            $finduser = User::where('google_id', $user->getId())->first();
            if ($finduser) {
                Auth::login($finduser);
                return redirect()->intended('/');
            } else {
                $newUser = User::create([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'google_id' => $user->getId(),
                    'address' => 'TAIKOTOKKK',
                    'gender' => 'Male',
                    'password' => encrypt('password')
                ]);
                Auth::login($newUser);
                return redirect()->intended('/');
            }
        } catch (\Throwable $e) {
            # code...
        }
    }
}
