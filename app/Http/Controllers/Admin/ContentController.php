<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function blogs()
    {
        $blogs = [
            ['id' => 1, 'title' => 'How to Crack Section Officer in First Attempt', 'author' => 'Admin', 'views' => 1500],
            ['id' => 2, 'title' => 'Important Dates for 2081 Exams', 'author' => 'Editor', 'views' => 3200],
        ];
        return view('admin.content.blogs', compact('blogs'));
    }

    public function testimonials()
    {
        $testimonials = [
            ['id' => 1, 'user' => 'Ram Sharma', 'text' => 'Best platform for LokSewa!', 'rating' => 5],
        ];
        return view('admin.content.testimonials', compact('testimonials'));
    }

    public function faqs()
    {
        $faqs = [
            ['id' => 1, 'question' => 'How to join a course?', 'answer' => 'You can join via pricing page.'],
        ];
        return view('admin.content.faqs', compact('faqs'));
    }
}
