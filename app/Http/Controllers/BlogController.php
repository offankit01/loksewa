<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('is_published', true)
            ->with('author')
            ->latest()
            ->paginate(10);
            
        return view('blogs.index', compact('blogs'));
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)
            ->where('is_published', true)
            ->with('author')
            ->firstOrFail();

        // Increment views
        $blog->increment('views');

        $recentBlogs = Blog::where('is_published', true)
            ->where('slug', '!=', $slug)
            ->latest()
            ->take(3)
            ->get();

        return view('blogs.show', compact('blog', 'recentBlogs'));
    }
}
