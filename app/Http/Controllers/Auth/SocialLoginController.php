<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    /**
     * Return to specific Socialite provider
     *
     */
    public function login($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Callback of auth specific provider login
     *
     */
    public function callback($provider)
    {
        try {
            $socialiteUser = Socialite::driver($provider)->user();
            // Check if user email is exist
            $user = User::where('email', $socialiteUser->getEmail())->first() ?? self::createSocialiteUser($socialiteUser, $provider);
            if($user){
                $user->provider_id = $socialiteUser->getId();
                $user->update();
            }
            Auth::loginUsingId($user->id);
            return redirect()->route('home');
        } catch (\Throwable $th) {
            Log::error('An error has occurred please try again later.');
            return redirect()->route('login')->withErrors($th->getMessage());
        }
    }

    /**
     * Create new user with socialite provider
     *
     */
    private function createSocialiteUser($socialiteUser, $provider)
    {
        return User::create([
            'name' => $socialiteUser->getName(),
            'email' => $socialiteUser->getEmail(),
            'password' => Hash::make(Str::random(8)),
            'provider_id' => $socialiteUser->getId(),
            'provider_name' => $provider
        ]);
    }
}
