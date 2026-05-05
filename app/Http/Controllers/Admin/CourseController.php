<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::withCount('mockTests')->orderBy('title', 'asc')->get();
        return view('admin.courses.index', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required|string|max:255']);
        Course::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'is_active' => true
        ]);
        return back()->with('success', 'Service created successfully.');
    }
}
