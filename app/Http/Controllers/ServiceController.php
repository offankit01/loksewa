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
}
