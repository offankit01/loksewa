<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestimonialController extends Controller
{
    /**
     * Store a newly created testimonial in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|min:10|max:500',
        ]);

        $user = Auth::user();

        // Check if user already has a testimonial
        $existing = Testimonial::where('user_id', $user->id)->first();

        if ($existing) {
            $existing->update([
                'content' => $request->content,
                'rating' => $request->rating,
                // When a user updates, we might want to set is_active to false 
                // if we want admin to re-approve it. For now, keep it active.
                'is_active' => false, 
            ]);
            $message = 'Your testimonial has been updated and is pending review.';
        } else {
            Testimonial::create([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'designation' => 'Student', // Default designation for users
                'avatar' => $user->avatar, // Assuming user has avatar
                'content' => $request->content,
                'rating' => $request->rating,
                'is_active' => false, // New user testimonials are inactive by default
            ]);
            $message = 'Thank you for your feedback! It will be visible once approved by an admin.';
        }

        return back()->with('success', $message);
    }
}
