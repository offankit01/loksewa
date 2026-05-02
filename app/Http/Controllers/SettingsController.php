<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = [
            'notifications' => [
                'email_alerts' => true,
                'push_notifications' => false,
                'mock_test_reminders' => true,
                'newsletter' => true,
            ],
            'privacy' => [
                'public_profile' => false,
                'show_progress' => true,
            ],
            'language' => 'English',
        ];

        return view('settings.index', compact('settings'));
    }
}
