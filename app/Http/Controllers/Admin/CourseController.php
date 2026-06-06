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
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:50',
            'description' => 'nullable|string'
        ]);

        Course::create([
            'title' => $request->title,
            'category' => $request->category,
            'slug' => Str::slug($request->title),
            'icon' => $request->icon ?? 'bi-briefcase',
            'description' => $request->description,
            'is_active' => true
        ]);

        return back()->with('success', 'Service created successfully.');
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:50',
            'description' => 'nullable|string'
        ]);

        $course->update([
            'title' => $request->title,
            'category' => $request->category,
            'slug' => Str::slug($request->title),
            'icon' => $request->icon ?? 'bi-briefcase',
            'description' => $request->description
        ]);

        return back()->with('success', 'Service updated successfully.');
    }

    public function destroy(Course $course)
    {
        // Check if course has related tests
        if ($course->mockTests()->count() > 0) {
            return back()->with('error', 'Cannot delete service with existing mock tests.');
        }

        $course->delete();
        return back()->with('success', 'Service deleted successfully.');
    }

    public function toggleStatus(Course $course)
    {
        $course->update(['is_active' => !$course->is_active]);
        return back()->with('success', 'Service status updated.');
    }
}
