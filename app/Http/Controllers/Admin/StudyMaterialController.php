<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudyMaterial;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class StudyMaterialController extends Controller
{
    public function index()
    {
        $materials = StudyMaterial::latest()->get();
        return view('admin.materials.index', compact('materials'));
    }

    public function create()
    {
        $courses = Course::where('is_active', true)->orderBy('title')->get();
        
        // Define Main Category mapping for UI
        $mainCategories = [
            ['id' => 'admin', 'name' => 'Nepal Administrative Service', 'name_nep' => 'नेपाल प्रशासन सेवा', 'icon' => 'bi-briefcase'],
            ['id' => 'police', 'name' => 'Nepal Police Service', 'name_nep' => 'नेपाल प्रहरी सेवा', 'icon' => 'bi-shield-shaded'],
            ['id' => 'army', 'name' => 'Nepal Army Service', 'name_nep' => 'नेपाली सेना सेवा', 'icon' => 'bi-shield-fill-check'],
            ['id' => 'judicial', 'name' => 'Nepal Judicial Service', 'name_nep' => 'नेपाल न्याय सेवा', 'icon' => 'bi-balance-scale'],
            ['id' => 'foreign', 'name' => 'Nepal Foreign Affairs', 'name_nep' => 'नेपाल परराष्ट्र सेवा', 'icon' => 'bi-globe-asia-australia'],
            ['id' => 'audit', 'name' => 'Nepal Audit Service', 'name_nep' => 'नेपाल लेखापरीक्षण सेवा', 'icon' => 'bi-calculator'],
            ['id' => 'parliament', 'name' => 'Nepal Parliamentary', 'name_nep' => 'नेपाल संसदीय सेवा', 'icon' => 'bi-building'],
            ['id' => 'technical', 'name' => 'Technical Services', 'name_nep' => 'प्राविधिक सेवाहरू', 'icon' => 'bi-tools'],
        ];

        return view('admin.materials.create', compact('courses', 'mainCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string', // This will be the course slug for simplicity
            'type' => 'required|in:note,pyq',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:10240', // 10MB limit
            'is_premium' => 'boolean'
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . Str::slug($request->title) . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('materials', $fileName, 'public');
        }

        StudyMaterial::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title . '-' . uniqid()),
            'category' => $request->category,
            'type' => $request->type,
            'description' => $request->description,
            'file_path' => $filePath,
            'is_premium' => $request->has('is_premium'),
            'is_active' => true,
        ]);

        return redirect()->route('admin.materials.index')->with('success', 'Study Material uploaded successfully.');
    }

    public function upload()
    {
        return view('admin.materials.upload');
    }
}
