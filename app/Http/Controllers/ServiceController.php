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
        $materials = StudyMaterial::where('category', 'like', "%$slug%")
            ->where('type', 'note')
            ->latest()
            ->get();
        
        // If empty, just show some default ones for demo
        if ($materials->isEmpty()) {
            $materials = StudyMaterial::where('type', 'note')->latest()->take(3)->get();
        }

        return view('service.notes', compact('title', 'slug', 'materials'));
    }

    public function questions($slug)
    {
        $title = Str::headline($slug);
        $materials = StudyMaterial::where('category', 'like', "%$slug%")
            ->whereIn('type', ['pyq', 'model'])
            ->latest()
            ->get();

        if ($materials->isEmpty()) {
            $materials = StudyMaterial::whereIn('type', ['pyq', 'model'])->latest()->take(3)->get();
        }

        return view('service.questions', compact('title', 'slug', 'materials'));
    }

    public function syllabus($slug)
    {
        $title = Str::headline($slug);
        $materials = StudyMaterial::where('category', 'like', "%$slug%")
            ->where('type', 'syllabus')
            ->latest()
            ->get();

        if ($materials->isEmpty()) {
            $materials = StudyMaterial::where('type', 'syllabus')->latest()->take(1)->get();
        }

        return view('service.syllabus', compact('title', 'slug', 'materials'));
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
