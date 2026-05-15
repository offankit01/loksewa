<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->scopes(['email'])->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            if ($provider == 'facebook') {
                $socialUser = Socialite::driver($provider)->fields(['name', 'email'])->stateless()->user();
            } else {
                $socialUser = Socialite::driver($provider)->stateless()->user();
            }
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Authentication failed: ' . $e->getMessage());
        }

        if (!$socialUser->getEmail()) {
            return redirect('/login')->with('error', 'We could not get your email address from ' . ucfirst($provider) . '. Please make sure you have an email linked to your account.');
        }

        $user = User::where('social_id', $socialUser->getId())
                    ->where('social_type', $provider)
                    ->first();

        if (!$user) {
            // Check if user with same email exists
            $user = User::where('email', $socialUser->getEmail())->first();

            if ($user) {
                // Link social account to existing user
                $user->update([
                    'social_id' => $socialUser->getId(),
                    'social_type' => $provider,
                ]);
            } else {
                // Create new user
                $user = User::create([
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'social_id' => $socialUser->getId(),
                    'social_type' => $provider,
                    'password' => bcrypt(Str::random(16)), // Random password for social users
                    'email_verified_at' => now(), // Social users are pre-verified
                ]);
            }
        } else {
            // Ensure existing users who link social are also marked as verified if they weren't
            if (!$user->email_verified_at) {
                $user->update(['email_verified_at' => now()]);
            }
        }

        Auth::login($user);

        return redirect('/dashboard');
    }
}
