<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpgradeController extends Controller
{
    public function index()
    {
        // Mocking user plan data (in a real app, this would come from the database)
        $currentPlan = [
            'name' => 'Standard Plan',
            'price' => '499',
            'status' => 'Active',
            'expiry' => 'Dec 24, 2024',
            'features' => [
                'Unlimited Mock Tests',
                'Basic Study Library',
                'Score Analytics'
            ]
        ];

        $availablePlans = [
            [
                'name' => 'Premium Plan',
                'price' => '999',
                'duration' => 'Per Year',
                'recommended' => true,
                'features' => [
                    'Everything in Standard',
                    'Expert-curated Video Lectures',
                    'Downloadable PDF Notes',
                    '1-on-1 Mentorship Session',
                    'Priority Doubt Support'
                ]
            ],
            [
                'name' => 'Lifetime Access',
                'price' => '2499',
                'duration' => 'One-time Payment',
                'recommended' => false,
                'features' => [
                    'Everything in Premium',
                    'Unlimited Access Forever',
                    'Ad-free Experience',
                    'Exclusive Live Webinars',
                    'Interview Preparation'
                ]
            ]
        ];

        return view('upgrade.index', compact('currentPlan', 'availablePlans'));
    }
}
