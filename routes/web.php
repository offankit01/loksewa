<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pricing', function () {
    return view('pricing');
})->name('pricing');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/mock-tests', [App\Http\Controllers\MockTestController::class, 'index'])->name('mock-tests');
Route::get('/study-library', [App\Http\Controllers\StudyLibraryController::class, 'index'])->name('study-library');
Route::get('/performance', [App\Http\Controllers\PerformanceController::class, 'index'])->name('performance');
Route::get('/upgrade-plan', [App\Http\Controllers\UpgradeController::class, 'index'])->name('upgrade-plan');
Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings');
Route::get('/blogs', [App\Http\Controllers\BlogController::class, 'index'])->name('blogs.index');

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () { return view('admin.dashboard'); })->name('admin.dashboard');
    Route::get('/courses', [App\Http\Controllers\Admin\CourseController::class, 'index'])->name('admin.courses.index');
    Route::get('/materials', [App\Http\Controllers\Admin\StudyMaterialController::class, 'index'])->name('admin.materials.index');
    Route::get('/content/blogs', [App\Http\Controllers\Admin\ContentController::class, 'blogs'])->name('admin.content.blogs');
    Route::get('/content/testimonials', [App\Http\Controllers\Admin\ContentController::class, 'testimonials'])->name('admin.content.testimonials');
    Route::get('/content/faqs', [App\Http\Controllers\Admin\ContentController::class, 'faqs'])->name('admin.content.faqs');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/services', function () {
    return view('services');
})->name('services');

Route::prefix('service/{slug}')->group(function () {
    Route::get('/', [ServiceController::class, 'show'])->name('service.show');
    Route::get('/notes', [ServiceController::class, 'notes'])->name('service.notes');
    Route::get('/questions', [ServiceController::class, 'questions'])->name('service.questions');
    Route::get('/syllabus', [ServiceController::class, 'syllabus'])->name('service.syllabus');
    Route::get('/mock-tests', [ServiceController::class, 'mockTests'])->name('service.mock-tests');
    Route::get('/mock-tests/start', [ServiceController::class, 'attemptMock'])->name('service.mock-attempt');
    Route::post('/mock-tests/submit', [ServiceController::class, 'submitMock'])->name('service.mock-submit');
    Route::post('/enroll', [ServiceController::class, 'enroll'])->name('service.enroll');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/admin-login', function () {
    return view('admin.login');
})->name('admin.login');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        // Here we could also add a check to ensure user is admin
        if (!auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }
        return view('admin.dashboard');
    })->name('dashboard');
});

