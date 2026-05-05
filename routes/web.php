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

Route::get('/mock-tests', [App\Http\Controllers\MockTestController::class, 'index'])->name('mock-tests.index');
Route::get('/mock-tests/{mockTest:slug}/start', [App\Http\Controllers\MockTestController::class, 'start'])->name('mock-tests.start');
Route::post('/mock-tests/{mockTest:slug}/attempt', [App\Http\Controllers\MockTestController::class, 'attempt'])->name('mock-tests.attempt');
Route::get('/materials/{material:slug}/generate-test', [App\Http\Controllers\MockTestController::class, 'autoGenerate'])->name('materials.generate-test');

Route::get('/performance', [App\Http\Controllers\PerformanceController::class, 'index'])->name('performance');
Route::get('/upgrade-plan', [App\Http\Controllers\UpgradeController::class, 'index'])->name('upgrade-plan');
Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings');
Route::get('/blogs', [App\Http\Controllers\BlogController::class, 'index'])->name('blogs.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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

    // Notifications
    Route::post('/notifications/{id}/read', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');

    // Settings actions
    Route::patch('/settings/email', [App\Http\Controllers\SettingsController::class, 'updateEmail'])->name('settings.email');
    Route::post('/settings/verification', [App\Http\Controllers\SettingsController::class, 'sendVerification'])->name('settings.verification');
    Route::patch('/settings/notifications', [App\Http\Controllers\SettingsController::class, 'updateNotifications'])->name('settings.notifications');
    Route::patch('/settings/theme', [App\Http\Controllers\SettingsController::class, 'updateTheme'])->name('settings.theme');
    Route::post('/settings/2fa', [App\Http\Controllers\SettingsController::class, 'toggle2FA'])->name('settings.2fa');
    Route::post('/settings/logout-sessions', [App\Http\Controllers\SettingsController::class, 'logoutOtherSessions'])->name('settings.logout-sessions');
});

require __DIR__.'/auth.php';

Route::get('/admin-login', function () {
    return view('admin.login');
})->name('admin.login');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard check
    Route::get('/dashboard', function () {
        if (!auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }
        return view('admin.dashboard');
    })->name('dashboard');

    // User Management
    Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
    Route::patch('/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{user}/toggle-admin', [App\Http\Controllers\Admin\UserController::class, 'toggleAdmin'])->name('users.toggle-admin');
    Route::post('/users/{user}/toggle-status', [App\Http\Controllers\Admin\UserController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::post('/users/{user}/reset-password', [App\Http\Controllers\Admin\UserController::class, 'resetPassword'])->name('users.reset-password');

    // Mock Test Management
    Route::get('/tests', [App\Http\Controllers\Admin\MockTestController::class, 'index'])->name('tests.index');
    Route::get('/tests/create', [App\Http\Controllers\Admin\MockTestController::class, 'create'])->name('tests.create');
    Route::post('/tests', [App\Http\Controllers\Admin\MockTestController::class, 'store'])->name('tests.store');
    Route::delete('/tests/{test}', [App\Http\Controllers\Admin\MockTestController::class, 'destroy'])->name('tests.destroy');
    Route::post('/tests/{test}/toggle-publish', [App\Http\Controllers\Admin\MockTestController::class, 'togglePublish'])->name('tests.toggle-publish');

    // Service (Course) Management
    Route::get('/courses', [App\Http\Controllers\Admin\CourseController::class, 'index'])->name('courses.index');
    Route::post('/courses', [App\Http\Controllers\Admin\CourseController::class, 'store'])->name('courses.store');
    
    // Study Materials
    Route::get('/materials', [App\Http\Controllers\Admin\StudyMaterialController::class, 'index'])->name('materials.index');
    Route::post('/materials/{material}/generate-test', [App\Http\Controllers\Admin\StudyMaterialController::class, 'generateMockTest'])->name('materials.generate-test');
    
    // Content Management
    Route::get('/content/blogs', [App\Http\Controllers\Admin\ContentController::class, 'blogs'])->name('content.blogs');
    Route::get('/content/testimonials', [App\Http\Controllers\Admin\ContentController::class, 'testimonials'])->name('content.testimonials');
    Route::get('/content/faqs', [App\Http\Controllers\Admin\ContentController::class, 'faqs'])->name('content.faqs');
});
