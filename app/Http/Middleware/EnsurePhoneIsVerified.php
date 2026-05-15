<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePhoneIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && 
            !$request->user()->email_verified_at && 
            $request->user()->phone && 
            !$request->is('verify-phone*') && 
            !$request->is('logout')) {
            return redirect()->route('otp.verify');
        }

        return $next($request);
    }
}
