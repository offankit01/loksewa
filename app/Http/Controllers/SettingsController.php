<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class SettingsController extends Controller
{
    /**
     * Display the settings page.
     */
    public function index()
    {
        // return "Settings page is working";
        $user = Auth::user();
        return view('settings.index', compact('user'));
    }

    /**
     * Update the user's email address.
     */
    public function updateEmail(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
        ]);

        $user = $request->user();
        $user->email = $request->email;

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return back()->with('status', 'email-updated');
    }

    /**
     * Send email verification notification.
     */
    public function sendVerification(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return back()->with('status', 'already-verified');
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-sent');
    }

    /**
     * Save notification preferences.
     */
    public function updateNotifications(Request $request): RedirectResponse
    {
        $request->user()->update([
            'notify_email_newsletter' => $request->boolean('notify_email_newsletter'),
            'notify_mock_tests'       => $request->boolean('notify_mock_tests'),
        ]);

        return back()->with('status', 'notifications-updated');
    }

    /**
     * Save theme preference.
     */
    public function updateTheme(Request $request): RedirectResponse
    {
        $request->validate([
            'theme' => ['required', 'in:light,dark,system'],
        ]);

        $request->user()->update(['theme_preference' => $request->theme]);

        return back()->with('status', 'theme-updated');
    }

    /**
     * Toggle Two-Factor Authentication on/off.
     */
    public function toggle2FA(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->two_fa_enabled) {
            // Disable 2FA
            $user->update(['two_fa_enabled' => false, 'two_fa_secret' => null]);
            return back()->with('status', '2fa-disabled');
        }

        // Enable 2FA (simplified — in production use google2fa or similar)
        $secret = strtoupper(bin2hex(random_bytes(10)));
        $user->update(['two_fa_enabled' => true, 'two_fa_secret' => $secret]);

        return back()->with('status', '2fa-enabled');
    }

    /**
     * Logout all other sessions.
     */
    public function logoutOtherSessions(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        Auth::logoutOtherDevices($request->password);

        return back()->with('status', 'sessions-cleared');
    }
}
