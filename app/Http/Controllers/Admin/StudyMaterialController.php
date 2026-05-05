<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudyMaterial;
use App\Models\MockTest;
use App\Services\MockTestGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StudyMaterialController extends Controller
{
    public function index()
    {
        $materials = StudyMaterial::latest()->get();
        
        // If empty, seed some for demo
        if ($materials->isEmpty()) {
            StudyMaterial::create([
                'title' => 'Ancient History of Nepal',
                'slug' => 'ancient-history-nepal',
                'description' => 'A comprehensive guide to the Licchavi and Malla periods.',
                'content' => 'The history of Nepal is characterized by its location in the Himalayas... The Licchavi dynasty ruled from the 4th to 9th centuries...',
                'category' => 'History',
            ]);
            $materials = StudyMaterial::latest()->get();
        }

        return view('admin.materials.index', compact('materials'));
    }

    public function generateMockTest(Request $request, StudyMaterial $material)
    {
        $generator = new MockTestGenerator();
        $difficulty = $request->input('difficulty', 'medium');
        $mockTest = $generator->generate($material, $difficulty);

        return redirect()->route('admin.materials.index')
            ->with('success', "AI Mock Test '{$mockTest->title}' generated successfully for {$material->title}!");
    }

    public function upload()
    {
        return view('admin.materials.upload');
    }
}
