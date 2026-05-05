<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudyLibraryController extends Controller
{
    public function index()
    {
        // Sample data for study materials
        $categories = [
            ['name' => 'General Knowledge', 'icon' => 'bi-globe-asia-australia', 'count' => 120],
            ['name' => 'IQ & Aptitude', 'icon' => 'bi-brain', 'count' => 85],
            ['name' => 'Nepal History', 'icon' => 'bi-bank', 'count' => 45],
            ['name' => 'Constitution', 'icon' => 'bi-book', 'count' => 30],
            ['name' => 'Geography', 'icon' => 'bi-map', 'count' => 60],
            ['name' => 'Current Affairs', 'icon' => 'bi-newspaper', 'count' => 200],
        ];

        $recentMaterials = [
            ['title' => 'Ancient History of Nepal', 'category' => 'History', 'type' => 'PDF', 'date' => '2 days ago'],
            ['title' => 'Verbal Reasoning Guide', 'category' => 'IQ', 'type' => 'Note', 'date' => '3 days ago'],
            ['title' => 'Budget 2081/82 Analysis', 'category' => 'Economy', 'type' => 'PDF', 'date' => '1 week ago'],
        ];

        return view('study-library.index', compact('categories', 'recentMaterials'));
    }
    public function saved()
    {
        $recentMaterials = [
            ['title' => 'Ancient History of Nepal', 'category' => 'History', 'type' => 'PDF', 'date' => '2 days ago'],
            ['title' => 'Verbal Reasoning Guide', 'category' => 'IQ', 'type' => 'Note', 'date' => '3 days ago'],
            ['title' => 'Budget 2081/82 Analysis', 'category' => 'Economy', 'type' => 'PDF', 'date' => '1 week ago'],
        ];

        return view('study-library.saved', compact('recentMaterials'));
    }
}
