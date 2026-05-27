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
        $user = Auth::user();
        $attempts = TestAttempt::where('user_id', $user->id)
            ->with('mockTest')
            ->latest()
            ->get();

        $totalTests = $attempts->count();
        
        $avgScore = $totalTests > 0 
            ? ($attempts->sum('score') / ($totalTests * 100)) * 100 // Assuming score is out of 100 or relative
            : 0;

        $totalCorrect = $attempts->sum('correct_answers');
        $totalQuestions = $attempts->sum('total_questions');
        $accuracy = $totalQuestions > 0 ? ($totalCorrect / $totalQuestions) * 100 : 0;

        // Mocking weak topics for now, or could be derived from AttemptAnswer
        $weakTopics = [
            ['name' => 'General Knowledge', 'score' => 45],
            ['name' => 'Intelligence Quotient (IQ)', 'score' => 68],
            ['name' => 'Public Management', 'score' => 32],
        ];

        $mockTests = MockTest::where('is_published', true)->latest()->paginate(9);
        
        return view('mock-tests.index', compact(
            'mockTests', 
            'attempts', 
            'totalTests', 
            'avgScore', 
            'accuracy', 
            'weakTopics'
        ));
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
        
        $questions = $mockTest->questions()->get();
        $totalQuestions = $questions->count();
        $correctCount = 0;
        $incorrectCount = 0;
        
        // Pre-create attempt to get ID
        $attempt = TestAttempt::create([
            'user_id' => Auth::id(),
            'mock_test_id' => $mockTest->id,
            'score' => 0,
            'total_questions' => $totalQuestions,
            'correct_answers' => 0,
            'wrong_answers' => 0,
            'time_taken' => $request->input('time_taken', 0),
            'completed_at' => now(),
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

        // LokSewa Scoring: 2 marks per correct, -20% (0.4) for incorrect
        $score = ($correctCount * 2) - ($incorrectCount * 0.4);
        
        $attempt->update([
            'score' => max(0, $score),
            'correct_answers' => $correctCount,
            'wrong_answers' => $incorrectCount,
        ]);

        $result = [
            'title' => $mockTest->title,
            'total_questions' => $totalQuestions,
            'correct' => $correctCount,
            'incorrect' => $incorrectCount,
            'unattempted' => $totalQuestions - ($correctCount + $incorrectCount),
            'score' => number_format($score, 2),
            'percentage' => $totalQuestions > 0 ? number_format(($correctCount / $totalQuestions) * 100, 1) : 0,
            'status' => ($totalQuestions > 0 && ($score / ($totalQuestions * 2)) >= 0.4) ? 'Passed' : 'Failed',
            'date' => now()->format('M d, Y')
        ];

        return view('service.mock-result', compact('result', 'mockTest', 'attempt'));
    }
}
