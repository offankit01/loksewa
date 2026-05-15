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
            
        return view('welcome', compact('testimonials', 'faqs'));
    }
}
