<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Services\SmsService;

class OtpController extends Controller
{
    protected $smsService;

    public function __construct(SmsService $smsService)
    {
        $this->smsService = $smsService;
    }

    public function showVerifyForm()
    {
        if (Auth::user()->email_verified_at) {
            return redirect()->route('dashboard');
        }
        return view('auth.verify-phone');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric|digits:6',
        ]);

        $user = Auth::user();

        if ($user->otp === $request->otp && $user->otp_expires_at->isFuture()) {
            $user->update([
                'email_verified_at' => now(),
                'otp' => null,
                'otp_expires_at' => null,
            ]);

            return redirect()->route('dashboard')->with('success', 'Phone number verified successfully!');
        }

        return back()->withErrors(['otp' => 'Invalid or expired OTP code.']);
    }

    public function resend()
    {
        $user = Auth::user();
        $otp = rand(100000, 999999);
        
        $user->update([
            'otp' => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        // Send Real-Time OTP
        $this->smsService->sendOtp($user->phone, $otp);

        return back()->with('success', 'A new OTP has been sent to your phone.');
    }
}
