<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Testimonial::create([
            'user_name' => $request->user_name,
            'designation' => $request->designation,
            'content' => $request->content,
            'rating' => $request->rating,
            'is_active' => true,
            'is_featured' => true, // Make it appear on home page automatically
        ]);

        return back()->with('success', 'Your feedback has been submitted successfully and is now featured on our homepage!');
    }
}
