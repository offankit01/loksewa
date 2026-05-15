<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = $this->getMockBlogs();
        return view('blogs.index', compact('blogs'));
    }

    public function show($slug)
    {
        $blogs = $this->getMockBlogs();
        $blog = collect($blogs)->firstWhere('slug', $slug);

        if (!$blog) {
            abort(404);
        }

        $recentBlogs = collect($blogs)->where('slug', '!=', $slug)->take(3);

        return view('blogs.show', compact('blog', 'recentBlogs'));
    }

    private function getMockBlogs()
    {
        return [
            [
                'slug' => 'top-10-tips-to-crack-loksewa-exams',
                'title' => 'Top 10 Tips to Crack LokSewa Exams',
                'excerpt' => 'Preparation is the key to success. Here are the top 10 strategies used by toppers to master the syllabus.',
                'author' => 'Admin',
                'date' => 'May 15, 2024',
                'image' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&q=80&w=800'
            ],
            [
                'slug' => 'understanding-new-exam-pattern-2081',
                'title' => 'Understanding the New Exam Pattern 2081',
                'excerpt' => 'The commission has recently updated the syllabus. Stay updated with the latest changes and marking schemes.',
                'author' => 'Exam Cell',
                'date' => 'May 12, 2024',
                'image' => 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?auto=format&fit=crop&q=80&w=800'
            ],
            [
                'slug' => 'daily-gk-current-affairs-capsule',
                'title' => 'Daily GK & Current Affairs Capsule',
                'excerpt' => 'Stay ahead with our daily summary of national and international news relevant to upcoming examinations.',
                'author' => 'News Team',
                'date' => 'May 10, 2024',
                'image' => 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?auto=format&fit=crop&q=80&w=800'
            ],
            [
                'slug' => 'mathematics-shortcuts-fast-calculation',
                'title' => 'Mathematics Shortcuts for Fast Calculation',
                'excerpt' => 'Learn the mental math tricks that will save you precious minutes during the quantitative section.',
                'author' => 'Prof. Sharma',
                'date' => 'May 08, 2024',
                'image' => 'https://images.unsplash.com/photo-1635070041078-e363dbe005cb?auto=format&fit=crop&q=80&w=800'
            ],
            [
                'slug' => 'role-of-digital-literacy-civil-service',
                'title' => 'The Role of Digital Literacy in Civil Service',
                'excerpt' => 'How technology is reshaping the government sector and why you need to stay tech-savvy.',
                'author' => 'Tech Team',
                'date' => 'May 05, 2024',
                'image' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?auto=format&fit=crop&q=80&w=800'
            ],
            [
                'slug' => 'effective-note-taking-competitive-exams',
                'title' => 'Effective Note Taking for Competitive Exams',
                'excerpt' => 'Discover the Cornell method and mind mapping techniques to retain information longer.',
                'author' => 'Anjali Thapa',
                'date' => 'May 02, 2024',
                'image' => 'https://images.unsplash.com/photo-1517842645767-c639042777db?auto=format&fit=crop&q=80&w=800'
            ]
        ];
    }
}
