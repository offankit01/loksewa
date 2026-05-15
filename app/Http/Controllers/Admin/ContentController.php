<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function blogs()
    {
        $blogs = \App\Models\Blog::with('author')->latest()->get();
        return view('admin.content.blogs', compact('blogs'));
    }

    public function createBlog()
    {
        return view('admin.content.blogs_create');
    }

    public function storeBlog(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blogs', 'public');
        }

        \App\Models\Blog::create([
            'title' => $request->title,
            'slug' => \Illuminate\Support\Str::slug($request->title) . '-' . uniqid(),
            'content' => $request->content,
            'excerpt' => $request->excerpt,
            'image' => $imagePath,
            'user_id' => auth()->id(),
            'is_published' => $request->has('is_published'),
        ]);

        return redirect()->route('admin.content.blogs')->with('success', 'Blog post created successfully.');
    }

    public function editBlog(\App\Models\Blog $blog)
    {
        return view('admin.content.blogs_edit', compact('blog'));
    }

    public function updateBlog(Request $request, \App\Models\Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($blog->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($blog->image);
            }
            $blog->image = $request->file('image')->store('blogs', 'public');
        }

        $blog->update([
            'title' => $request->title,
            'content' => $request->content,
            'excerpt' => $request->excerpt,
            'is_published' => $request->has('is_published'),
        ]);

        return redirect()->route('admin.content.blogs')->with('success', 'Blog post updated successfully.');
    }

    public function destroyBlog(\App\Models\Blog $blog)
    {
        if ($blog->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($blog->image);
        }
        $blog->delete();
        return back()->with('success', 'Blog post deleted successfully.');
    }

    public function testimonials()
    {
        $testimonials = \App\Models\Testimonial::latest()->get();
        return view('admin.content.testimonials', compact('testimonials'));
    }

    public function storeTestimonial(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
        ]);

        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('testimonials', 'public');
        }

        \App\Models\Testimonial::create([
            'user_name' => $request->user_name,
            'designation' => $request->designation,
            'content' => $request->content,
            'rating' => $request->rating,
            'avatar' => $avatarPath,
            'is_featured' => $request->has('is_featured'),
            'is_active' => true,
        ]);

        return back()->with('success', 'Testimonial added successfully.');
    }

    public function updateTestimonial(Request $request, \App\Models\Testimonial $testimonial)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
        ]);

        if ($request->hasFile('avatar')) {
            if ($testimonial->avatar) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($testimonial->avatar);
            }
            $testimonial->avatar = $request->file('avatar')->store('testimonials', 'public');
        }

        $testimonial->update([
            'user_name' => $request->user_name,
            'designation' => $request->designation,
            'content' => $request->content,
            'rating' => $request->rating,
            'is_featured' => $request->has('is_featured'),
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Testimonial updated successfully.');
    }

    public function destroyTestimonial(\App\Models\Testimonial $testimonial)
    {
        if ($testimonial->avatar) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($testimonial->avatar);
        }
        $testimonial->delete();
        return back()->with('success', 'Testimonial deleted successfully.');
    }

    public function faqs()
    {
        $faqs = \App\Models\Faq::orderBy('order')->latest()->get();
        return view('admin.content.faqs', compact('faqs'));
    }

    public function storeFaq(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'order' => 'nullable|integer',
        ]);

        \App\Models\Faq::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'order' => $request->order ?? 0,
            'is_active' => true,
        ]);

        return back()->with('success', 'FAQ added successfully.');
    }

    public function updateFaq(Request $request, \App\Models\Faq $faq)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'order' => 'nullable|integer',
        ]);

        $faq->update([
            'question' => $request->question,
            'answer' => $request->answer,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'FAQ updated successfully.');
    }

    public function plans()
    {
        $plans = \App\Models\Plan::latest()->get();
        $subscriptions = \App\Models\Subscription::with(['user', 'plan'])->latest()->get();
        return view('admin.content.plans', compact('plans', 'subscriptions'));
    }

    public function storePlan(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|string|max:255',
            'features' => 'required|string',
        ]);

        \App\Models\Plan::create([
            'name' => $request->name,
            'price' => $request->price,
            'duration' => $request->duration,
            'features' => $request->features,
            'is_popular' => $request->has('is_popular'),
            'is_active' => true,
        ]);

        return back()->with('success', 'Pricing plan added successfully.');
    }

    public function updatePlan(Request $request, \App\Models\Plan $plan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|string|max:255',
            'features' => 'required|string',
        ]);

        $plan->update([
            'name' => $request->name,
            'price' => $request->price,
            'duration' => $request->duration,
            'features' => $request->features,
            'is_popular' => $request->has('is_popular'),
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Pricing plan updated successfully.');
    }

    public function destroyPlan(\App\Models\Plan $plan)
    {
        $plan->delete();
        return back()->with('success', 'Pricing plan deleted successfully.');
    }
}
