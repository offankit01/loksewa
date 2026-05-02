<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = [
            ['id' => 1, 'name' => 'Section Officer', 'service' => 'Administrative', 'students' => 450, 'status' => 'Active'],
            ['id' => 2, 'name' => 'Nayab Subba', 'service' => 'Justice', 'students' => 320, 'status' => 'Active'],
            ['id' => 3, 'name' => 'Kharidar', 'service' => 'Parliamentary', 'students' => 150, 'status' => 'Draft'],
        ];
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }
}
