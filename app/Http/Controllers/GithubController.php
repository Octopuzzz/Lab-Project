<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Routing\Controller;
use Laravel\Socialite\Facades\Socialite;

class GithubController extends Controller
{
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }
    public function handleGithubCallback()
    {
        try {
            $user = Socialite::driver('github')->user();
            $findUser = User::Where('email', $user->getEmail())->first();
            if ($findUser) {
                Auth::login($findUser);
                return redirect()->intended('/');
            } else {
                $newUser = User::create([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'github_id' => $user->getId(),
                    'github_token' => $user->token,
                    'github_refresh_token' => $user->refreshToken,
                ]);
                Auth::login($newUser);
            }
            return redirect('/');
        } catch (\Throwable $e) {
            throw $e;
        }
    }
}
