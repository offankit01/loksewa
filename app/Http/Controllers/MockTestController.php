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

    public function autoGenerate(Request $request, \App\Models\StudyMaterial $material)
    {
        $difficulty = $request->input('difficulty', 'medium');
        
        // Check if an AI test already exists for this material and difficulty
        $existingTest = MockTest::where('study_material_id', $material->id)
            ->where('difficulty', $difficulty)
            ->where('is_ai_generated', true)
            ->first();

        if ($existingTest) {
            return redirect()->route('mock-tests.start', $existingTest->slug);
        }

        // Generate new test
        $generator = new \App\Services\MockTestGenerator();
        $mockTest = $generator->generate($material, $difficulty);

        return redirect()->route('mock-tests.start', $mockTest->slug)
            ->with('success', 'AI has generated a fresh practice test for you!');
    }
}
