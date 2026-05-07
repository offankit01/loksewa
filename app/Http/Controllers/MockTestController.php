<?php

namespace App\Http\Controllers;

use App\Models\MockTest;
use App\Models\Question;
use App\Models\TestAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MockTestController extends Controller
{
    public function index()
    {
        $mockTests = MockTest::where('is_published', true)->latest()->paginate(9);
        return view('mock-tests.index', compact('mockTests'));
    }

    public function start(MockTest $mockTest)
    {
        return view('mock-tests.start', compact('mockTest'));
    }

    public function attempt(Request $request, MockTest $mockTest)
    {
        $difficulty = $request->input('difficulty', 'medium');
        
        $questions = $mockTest->questions()
            ->where('difficulty', $difficulty)
            ->inRandomOrder()
            ->get();

        if ($questions->isEmpty()) {
            $questions = $mockTest->questions()->inRandomOrder()->get();
        }

        if ($questions->isEmpty()) {
            return back()->with('error', 'No questions available for this test yet.');
        }

        return view('service.mock-attempt', [
            'mockTest' => $mockTest,
            'questions' => $questions,
            'difficulty' => $difficulty
        ]);
    }
    public function submit(Request $request, MockTest $mockTest)
    {
        $userAnswers = json_decode($request->input('answers', '[]'), true);
        $difficulty = $request->input('difficulty', 'medium');
        
        // Fetch questions for this test and difficulty to validate
        $questions = $mockTest->questions()->where('difficulty', $difficulty)->get();
        if ($questions->isEmpty()) {
            $questions = $mockTest->questions()->get();
        }

        $totalQuestions = $questions->count();
        $correctCount = 0;
        $incorrectCount = 0;
        
        $attempt = TestAttempt::create([
            'user_id' => Auth::id(),
            'mock_test_id' => $mockTest->id,
            'difficulty' => $difficulty,
            'score' => 0, // Will update below
            'time_taken' => 0, // Placeholder
            'status' => 'completed'
        ]);

        foreach ($questions as $index => $q) {
            $submittedAnswer = $userAnswers[$index] ?? null;
            $isCorrect = $submittedAnswer === $q->correct_option;
            
            if ($submittedAnswer) {
                if ($isCorrect) $correctCount++;
                else $incorrectCount++;
            }

            \App\Models\AttemptAnswer::create([
                'test_attempt_id' => $attempt->id,
                'question_id' => $q->id,
                'submitted_answer' => $submittedAnswer,
                'is_correct' => $isCorrect
            ]);
        }

        // Standard LokSewa Scoring: 2 marks per correct, -20% (0.4) for incorrect
        $marksPerCorrect = 2;
        $penaltyPerIncorrect = 0.4;
        $score = ($correctCount * $marksPerCorrect) - ($incorrectCount * $penaltyPerIncorrect);
        
        $attempt->update(['score' => max(0, $score)]);

        $result = [
            'title' => $mockTest->title,
            'total_questions' => $totalQuestions,
            'correct' => $correctCount,
            'incorrect' => $incorrectCount,
            'unattempted' => $totalQuestions - ($correctCount + $incorrectCount),
            'score' => number_format($score, 2),
            'percentage' => number_format(($score / ($totalQuestions * 2)) * 100, 1),
            'status' => ($score / ($totalQuestions * 2)) >= 0.4 ? 'Passed' : 'Failed',
            'date' => now()->format('M d, Y h:i A')
        ];

        return view('service.mock-result', [
            'result' => $result,
            'mockTest' => $mockTest,
            'slug' => 'kharidar' // Fallback for the view logic
        ]);
    }
}
