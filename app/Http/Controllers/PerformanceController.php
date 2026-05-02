<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    public function index()
    {
        // Mock data for performance analytics
        $monthlyProgress = [
            ['month' => 'Jan', 'score' => 65],
            ['month' => 'Feb', 'score' => 72],
            ['month' => 'Mar', 'score' => 68],
            ['month' => 'Apr', 'score' => 84],
            ['month' => 'May', 'score' => 90],
        ];

        $subjectPerformance = [
            ['subject' => 'General Knowledge', 'score' => 85, 'color' => 'bg-primary-blue'],
            ['subject' => 'IQ & Aptitude', 'score' => 60, 'color' => 'bg-accent-orange'],
            ['subject' => 'Current Affairs', 'score' => 92, 'color' => 'bg-success'],
            ['subject' => 'Constitution', 'score' => 75, 'color' => 'bg-info'],
        ];

        $stats = [
            'rank' => '124th',
            'percentile' => '92%',
            'avg_time' => '38s',
            'tests_completed' => 15
        ];

        return view('performance.index', compact('monthlyProgress', 'subjectPerformance', 'stats'));
    }
}
