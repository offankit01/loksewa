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
        $materials = StudyMaterial::with('course')->latest()->get();
        return view('admin.materials.index', compact('materials'));
    }

    public function create()
    {
        $courses = Course::where('is_active', true)->orderBy('title')->get();
        
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
            'course_id' => 'required|exists:courses,id',
            'type' => 'required|in:note,pyq,syllabus,model',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:10240',
            'is_premium' => 'boolean'
        ]);

        $course = Course::findOrFail($request->course_id);

        $filePath = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . Str::slug($request->title) . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('materials', $fileName, 'public');
        }

        StudyMaterial::create([
            'course_id' => $request->course_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title . '-' . uniqid()),
            'category' => $course->slug, // Keep category slug for compatibility
            'type' => $request->type,
            'description' => $request->description ?? null,
            'file_path' => $filePath,
            'is_premium' => $request->has('is_premium'),
            'is_active' => true,
        ]);

        return redirect()->route('admin.materials.index')->with('success', 'Study Material uploaded successfully.');
    }

    public function edit(StudyMaterial $material)
    {
        $courses = Course::where('is_active', true)->orderBy('title')->get();
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

        return view('admin.materials.edit', compact('material', 'courses', 'mainCategories'));
    }

    public function update(Request $request, StudyMaterial $material)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'type' => 'required|in:note,pyq,syllabus,model',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:10240',
            'is_premium' => 'boolean'
        ]);

        $course = Course::findOrFail($request->course_id);

        $data = [
            'course_id' => $request->course_id,
            'title' => $request->title,
            'category' => $course->slug,
            'type' => $request->type,
            'description' => $request->description ?? null,
            'is_premium' => $request->has('is_premium'),
        ];

        if ($request->hasFile('file')) {
            // Delete old file
            if ($material->file_path) {
                Storage::disk('public')->delete($material->file_path);
            }

            $file = $request->file('file');
            $fileName = time() . '_' . Str::slug($request->title) . '.' . $file->getClientOriginalExtension();
            $data['file_path'] = $file->storeAs('materials', $fileName, 'public');
        }

        $material->update($data);

        return redirect()->route('admin.materials.index')->with('success', 'Study Material updated successfully.');
    }

    public function destroy(StudyMaterial $material)
    {
        if ($material->file_path) {
            Storage::disk('public')->delete($material->file_path);
        }
        $material->delete();

        return redirect()->route('admin.materials.index')->with('success', 'Study Material deleted successfully.');
    }

    public function upload()
    {
        return view('admin.materials.upload');
    }
}
