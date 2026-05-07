<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MockTest;
use Illuminate\Http\Request;

class MockTestController extends Controller
{
    public function index()
    {
        $tests = MockTest::with(['course', 'studyMaterial'])->withCount('questions')->latest()->paginate(10);
        return view('admin.tests.index', compact('tests'));
    }

    public function create()
    {
        $courses = \App\Models\Course::where('is_active', true)->orderBy('title')->get();
        
        // Define Main Category mapping for UI
        $mainCategories = [
            ['id' => 'admin', 'name' => 'Nepal Administrative Service', 'name_nep' => 'नेपाल प्रशासन सेवा', 'icon' => 'bi-briefcase'],
            ['id' => 'police', 'name' => 'Nepal Police Service', 'name_nep' => 'नेपाल प्रहरी सेवा', 'icon' => 'bi-shield-shaded'],
            ['id' => 'army', 'name' => 'Nepal Army Service', 'name_nep' => 'नेपाली सेना सेवा', 'icon' => 'bi-shield-fill-check'],
            ['id' => 'judicial', 'name' => 'Nepal Judicial Service', 'name_nep' => 'नेपाल न्याय सेवा', 'icon' => 'bi-balance-scale'],
            ['id' => 'foreign', 'name' => 'Nepal Foreign Affairs', 'name_nep' => 'नेपाल परराष्ट्र सेवा', 'icon' => 'bi-globe-asia-australia'],
            ['id' => 'audit', 'name' => 'Nepal Audit Service', 'name_nep' => 'नेपाल लेखापरीक्षण सेवा', 'icon' => 'bi-calculator'],
            ['id' => 'parliament', 'name' => 'Nepal Parliamentary', 'name_nep' => 'नेपाल संसदीय सेवा', 'icon' => 'bi-building'],
            ['id' => 'technical', 'name' => 'Technical Services', 'name_nep' => 'प्राविधिक सेवाहरू', 'icon' => 'bi-tools'],
        ];

        return view('admin.tests.create', compact('courses', 'mainCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'time_limit' => 'required|integer|min:1',
            'difficulty' => 'required|in:easy,medium,hard',
            'questions' => 'required|array|min:1',
            'questions.*.text' => 'required|string',
            'questions.*.a' => 'required|string',
            'questions.*.b' => 'required|string',
            'questions.*.c' => 'required|string',
            'questions.*.d' => 'required|string',
            'questions.*.correct' => 'required|in:a,b,c,d',
        ]);

        $test = MockTest::create([
            'title' => $request->title,
            'slug' => \Illuminate\Support\Str::slug($request->title . '-' . uniqid()),
            'course_id' => $request->course_id,
            'time_limit' => $request->time_limit,
            'difficulty' => $request->difficulty,
            'is_ai_generated' => false,
            'is_published' => true,
        ]);

        foreach ($request->questions as $q) {
            $test->questions()->create([
                'question_text' => $q['text'],
                'option_a' => $q['a'],
                'option_b' => $q['b'],
                'option_c' => $q['c'],
                'option_d' => $q['d'],
                'correct_option' => $q['correct'],
                'difficulty' => $request->difficulty,
            ]);
        }

        return redirect()->route('admin.tests.index')->with('success', 'Manual Mock Test created successfully.');
    }

    public function destroy(MockTest $test)
    {
        $test->delete();
        return back()->with('success', 'Mock test deleted successfully.');
    }

    public function togglePublish(MockTest $test)
    {
        $test->is_published = !$test->is_published;
        $test->save();
        return back()->with('success', 'Mock test status updated.');
    }
}
