<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Display the detail page for a specific service.
     */
    public function show($slug)
    {
        $title = Str::headline($slug);
        return view('service-detail', compact('title', 'slug'));
    }

    public function notes($slug)
    {
        $title = Str::headline($slug);
        return view('service.notes', compact('title', 'slug'));
    }

    public function questions($slug)
    {
        $title = Str::headline($slug);
        return view('service.questions', compact('title', 'slug'));
    }

    public function syllabus($slug)
    {
        $title = Str::headline($slug);
        return view('service.syllabus', compact('title', 'slug'));
    }

    public function mockTests($slug)
    {
        $title = Str::headline($slug);
        return view('service.mock-tests', compact('title', 'slug'));
    }

    public function enroll(Request $request, $slug)
    {
        // In a real application, we would save the enrollment to the database here
        // For now, we simulate success and redirect to dashboard
        return redirect()->route('dashboard')->with('success', 'Successfully enrolled in ' . Str::headline($slug) . '!');
    }

    public function attemptMock($slug)
    {
        $title = Str::headline($slug);
        
        // Mock questions for the attempt
        $questions = [
            [
                'id' => 1,
                'question' => 'Who is the first President of Nepal?',
                'options' => ['Dr. Ram Baran Yadav', 'Bidhya Devi Bhandari', 'Ram Chandra Poudel', 'Girija Prasad Koirala'],
                'correct' => 0
            ],
            [
                'id' => 2,
                'question' => 'Which is the highest peak in the world?',
                'options' => ['K2', 'Kangchenjunga', 'Mount Everest', 'Lhotse'],
                'correct' => 2
            ],
            [
                'id' => 3,
                'question' => 'When was Lok Sewa Aayog established?',
                'options' => ['2007 BS', '2008 BS', '2015 BS', '2017 BS'],
                'correct' => 1
            ],
            [
                'id' => 4,
                'question' => 'What is the capital of Nepal?',
                'options' => ['Pokhara', 'Lalitpur', 'Bhaktapur', 'Kathmandu'],
                'correct' => 3
            ],
            [
                'id' => 5,
                'question' => 'How many provinces are there in Nepal?',
                'options' => ['5', '6', '7', '8'],
                'correct' => 2
            ]
        ];

        return view('service.mock-attempt', compact('title', 'slug', 'questions'));
    }

    public function submitMock(Request $request, $slug)
    {
        $title = Str::headline($slug);
        
        // In a real app, we would fetch questions from DB and compare with user answers
        // Here we simulate the result based on some random success or provided data
        $totalQuestions = 50; // Simulation
        $correctAnswers = rand(30, 45);
        $incorrectAnswers = $totalQuestions - $correctAnswers - rand(0, 5); // Some unattempted
        $unattempted = $totalQuestions - $correctAnswers - $incorrectAnswers;
        
        $marksPerQuestion = 2;
        $negativeMarkingRate = 0.2; // 20%
        
        $score = ($correctAnswers * $marksPerQuestion) - ($incorrectAnswers * $marksPerQuestion * $negativeMarkingRate);
        $percentage = ($score / ($totalQuestions * $marksPerQuestion)) * 100;
        
        $result = [
            'title' => $title,
            'total_questions' => $totalQuestions,
            'correct' => $correctAnswers,
            'incorrect' => $incorrectAnswers,
            'unattempted' => $unattempted,
            'score' => number_format($score, 2),
            'percentage' => number_format($percentage, 1),
            'status' => $percentage >= 40 ? 'Passed' : 'Failed',
            'date' => now()->format('M d, Y h:i A')
        ];

        return view('service.mock-result', compact('result', 'slug'));
    }
}
