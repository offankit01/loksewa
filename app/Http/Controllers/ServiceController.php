<?php

namespace App\Http\Controllers;

use App\Models\StudyMaterial;
use App\Models\MockTest;
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
        // In real app, we would link slug to a Course ID. For now, simulate.
        $materials = StudyMaterial::where('category', 'like', "%$slug%")->latest()->get();
        
        // If empty, just show some default ones for demo
        if ($materials->isEmpty()) {
            $materials = StudyMaterial::latest()->take(3)->get();
        }

        return view('service.notes', compact('title', 'slug', 'materials'));
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
        
        // Get Manual tests for this section
        $manualTests = MockTest::where('is_ai_generated', false)->where('is_published', true)->latest()->get();
        
        // Get related Study Materials to offer AI generation
        $materials = StudyMaterial::where('category', 'like', "%$slug%")->latest()->get();
        if ($materials->isEmpty()) {
            $materials = StudyMaterial::latest()->take(2)->get();
        }

        return view('service.mock-tests', compact('title', 'slug', 'manualTests', 'materials'));
    }

    public function enroll(Request $request, $slug)
    {
        return redirect()->route('dashboard')->with('success', 'Successfully enrolled in ' . Str::headline($slug) . '!');
    }

    // Attempt logic is now handled by MockTestController for consistency
}
