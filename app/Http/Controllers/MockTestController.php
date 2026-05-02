<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MockTest;
use App\Models\TestAttempt;
use Illuminate\Support\Facades\Auth;

class MockTestController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Stats
        $totalTests = 12;
        $avgScore = 68.5;
        $accuracy = 74.2;
        $weakTopics = [
            ['name' => 'General Knowledge', 'score' => 45],
            ['name' => 'IQ & Aptitude', 'score' => 62],
            ['name' => 'Nepal History', 'score' => 38],
            ['name' => 'Current Affairs', 'score' => 55],
        ];

        // In a real app, we would fetch these from DB
        if ($user && $user->id == 999) { // Dummy check to show real logic structure
            $attempts = TestAttempt::where('user_id', $user->id)->get();
            if ($attempts->count() > 0) {
                $totalTests = $attempts->count();
                $avgScore = $attempts->avg('score');
                $accuracy = ($avgScore / 100) * 100;
            }
        }

        $availableTests = MockTest::all();

        return view('mock-tests.index', compact('totalTests', 'avgScore', 'accuracy', 'weakTopics', 'availableTests'));
    }
}
