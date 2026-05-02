<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudyMaterialController extends Controller
{
    public function index()
    {
        $materials = [
            ['id' => 1, 'title' => 'Ancient History Notes', 'category' => 'History', 'downloads' => 1200, 'date' => '2024-05-10'],
            ['id' => 2, 'title' => 'Verbal Reasoning PDF', 'category' => 'IQ', 'downloads' => 850, 'date' => '2024-05-12'],
            ['id' => 3, 'title' => 'Constitution of Nepal 2072', 'category' => 'Law', 'downloads' => 2500, 'date' => '2024-05-15'],
        ];
        return view('admin.materials.index', compact('materials'));
    }

    public function upload()
    {
        return view('admin.materials.upload');
    }
}
