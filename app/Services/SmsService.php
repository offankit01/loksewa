<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsService
{
    /**
     * Send OTP SMS to the user.
     * 
     * @param string $phone
     * @param string $otp
     * @return bool
     */
    public function sendOtp($phone, $otp)
    {
        $message = "Your LokSewa Tayari verification code is: {$otp}. Valid for 10 minutes.";

        // 1. Log for development (Always active)
        Log::info("SMS SENT TO {$phone}: {$message}");

        // 2. Real API Integration
        try {
            // This is where you will put your API call later
            // Example:
            /*
            $response = Http::get('https://your-sms-api.com/send', [
                'auth_token' => 'YOUR_TOKEN',
                'to' => $phone,
                'text' => $message,
            ]);
            return $response->successful();
            */
            
            return true;
        } catch (\Exception $e) {
            Log::error("SMS API Error: " . $e->getMessage());
            return false;
        }
    }
}
