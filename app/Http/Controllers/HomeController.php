<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $testimonials = \App\Models\Testimonial::where('is_active', true)
            ->where('is_featured', true)
            ->latest()
            ->take(6)
            ->get();
            
        $faqs = \App\Models\Faq::where('is_active', true)
            ->orderBy('order')
            ->get();
        $features = \App\Models\Feature::where('is_active', true)
            ->orderBy('order')
            ->take(4)
            ->get();
            
        $blogs = \App\Models\Blog::where('is_published', true)
            ->with('author')
            ->latest()
            ->take(6)
            ->get();
            
        return view('welcome', compact('testimonials', 'faqs', 'features', 'blogs'));
    }
}
