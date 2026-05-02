<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = [
            [
                'title' => 'Top 10 Tips to Crack LokSewa Exams',
                'excerpt' => 'Preparation is the key to success. Here are the top 10 strategies used by toppers.',
                'author' => 'Admin',
                'date' => 'May 15, 2024',
                'image' => 'https://img.freepik.com/free-vector/blogging-concept-illustration_114360-788.jpg'
            ],
            [
                'title' => 'Understanding the New Exam Pattern 2081',
                'excerpt' => 'The commission has recently updated the syllabus. Stay updated with the latest changes.',
                'author' => 'Exam Cell',
                'date' => 'May 12, 2024',
                'image' => 'https://img.freepik.com/free-vector/writing-concept-illustration_114360-1011.jpg'
            ],
            [
                'title' => 'Daily GK & Current Affairs Capsule',
                'excerpt' => 'Stay ahead with our daily summary of national and international news relevant to exams.',
                'author' => 'News Team',
                'date' => 'May 10, 2024',
                'image' => 'https://img.freepik.com/free-vector/reading-news-concept-illustration_114360-1013.jpg'
            ]
        ];

        return view('blogs.index', compact('blogs'));
    }
}
