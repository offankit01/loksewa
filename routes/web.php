<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('auth/{provider}', [App\Http\Controllers\Auth\SocialController::class, 'redirectToProvider'])->name('social.redirect');
Route::get('auth/{provider}/callback', [App\Http\Controllers\Auth\SocialController::class, 'handleProviderCallback'])->name('social.callback');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/pricing', function () {
    $plans = \App\Models\Plan::where('is_active', true)->orderBy('price')->get();
    return view('pricing', compact('plans'));
})->name('pricing');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::post('/feedback', [App\Http\Controllers\FeedbackController::class, 'store'])->name('feedback.store');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Mock Tests
    Route::get('/mock-tests', [App\Http\Controllers\MockTestController::class, 'index'])->name('mock-tests.index');
    Route::get('/mock-tests/{mockTest:slug}/start', [App\Http\Controllers\MockTestController::class, 'start'])->name('mock-tests.start');
    Route::post('/mock-tests/{mockTest:slug}/attempt', [App\Http\Controllers\MockTestController::class, 'attempt'])->name('mock-tests.attempt');
    Route::post('/mock-tests/{mockTest:slug}/submit', [App\Http\Controllers\MockTestController::class, 'submit'])->name('mock-tests.submit');

    Route::get('/performance', [App\Http\Controllers\PerformanceController::class, 'index'])->name('performance');
    Route::get('/upgrade-plan', [App\Http\Controllers\UpgradeController::class, 'index'])->name('upgrade-plan');
    Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings');
});

Route::get('/blogs', [App\Http\Controllers\BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{slug}', [App\Http\Controllers\BlogController::class, 'show'])->name('blogs.show');

Route::middleware('auth')->group(function () {
    Route::get('/verify-phone', [App\Http\Controllers\Auth\OtpController::class, 'showVerifyForm'])->name('otp.verify');
    Route::post('/verify-phone', [App\Http\Controllers\Auth\OtpController::class, 'verify'])->name('otp.verify.submit');
    Route::post('/verify-phone/resend', [App\Http\Controllers\Auth\OtpController::class, 'resend'])->name('otp.resend');
});

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
    Route::post('/settings/2fa', [App\Http\Controllers\SettingsController::class, 'toggle2FA'])->name('settings.2fa');
    Route::post('/settings/logout-sessions', [App\Http\Controllers\SettingsController::class, 'logoutOtherSessions'])->name('settings.logout-sessions');

    // Testimonials
    Route::post('/testimonials', [App\Http\Controllers\TestimonialController::class, 'store'])->name('testimonials.store');
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
    Route::get('/tests/{test}/edit', [App\Http\Controllers\Admin\MockTestController::class, 'edit'])->name('tests.edit');
    Route::patch('/tests/{test}', [App\Http\Controllers\Admin\MockTestController::class, 'update'])->name('tests.update');
    Route::delete('/tests/{test}', [App\Http\Controllers\Admin\MockTestController::class, 'destroy'])->name('tests.destroy');
    Route::post('/tests/{test}/toggle-publish', [App\Http\Controllers\Admin\MockTestController::class, 'togglePublish'])->name('tests.toggle-publish');

    // Service (Course) Management
    Route::get('/courses', [App\Http\Controllers\Admin\CourseController::class, 'index'])->name('courses.index');
    Route::post('/courses', [App\Http\Controllers\Admin\CourseController::class, 'store'])->name('courses.store');
    Route::patch('/courses/{course}', [App\Http\Controllers\Admin\CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{course}', [App\Http\Controllers\Admin\CourseController::class, 'destroy'])->name('courses.destroy');
    Route::post('/courses/{course}/toggle-status', [App\Http\Controllers\Admin\CourseController::class, 'toggleStatus'])->name('courses.toggle-status');
    
    // Study Materials
    Route::resource('materials', App\Http\Controllers\Admin\StudyMaterialController::class);

    
    // Content Management
    Route::get('/content/blogs', [App\Http\Controllers\Admin\ContentController::class, 'blogs'])->name('content.blogs');
    Route::get('/content/blogs/create', [App\Http\Controllers\Admin\ContentController::class, 'createBlog'])->name('content.blogs.create');
    Route::post('/content/blogs', [App\Http\Controllers\Admin\ContentController::class, 'storeBlog'])->name('content.blogs.store');
    Route::get('/content/blogs/{blog}/edit', [App\Http\Controllers\Admin\ContentController::class, 'editBlog'])->name('content.blogs.edit');
    Route::patch('/content/blogs/{blog}', [App\Http\Controllers\Admin\ContentController::class, 'updateBlog'])->name('content.blogs.update');
    Route::delete('/content/blogs/{blog}', [App\Http\Controllers\Admin\ContentController::class, 'destroyBlog'])->name('content.blogs.destroy');
    Route::get('/content/testimonials', [App\Http\Controllers\Admin\ContentController::class, 'testimonials'])->name('content.testimonials');
    Route::post('/content/testimonials', [App\Http\Controllers\Admin\ContentController::class, 'storeTestimonial'])->name('content.testimonials.store');
    Route::patch('/content/testimonials/{testimonial}', [App\Http\Controllers\Admin\ContentController::class, 'updateTestimonial'])->name('content.testimonials.update');
    Route::delete('/content/testimonials/{testimonial}', [App\Http\Controllers\Admin\ContentController::class, 'destroyTestimonial'])->name('content.testimonials.destroy');
    Route::get('/content/faqs', [App\Http\Controllers\Admin\ContentController::class, 'faqs'])->name('content.faqs');
    Route::post('/content/faqs', [App\Http\Controllers\Admin\ContentController::class, 'storeFaq'])->name('content.faqs.store');
    Route::patch('/content/faqs/{faq}', [App\Http\Controllers\Admin\ContentController::class, 'updateFaq'])->name('content.faqs.update');
    Route::delete('/content/faqs/{faq}', [App\Http\Controllers\Admin\ContentController::class, 'destroyFaq'])->name('content.faqs.destroy');
    Route::get('/content/plans', [App\Http\Controllers\Admin\ContentController::class, 'plans'])->name('content.plans');
    Route::post('/content/plans', [App\Http\Controllers\Admin\ContentController::class, 'storePlan'])->name('content.plans.store');
    Route::patch('/content/plans/{plan}', [App\Http\Controllers\Admin\ContentController::class, 'updatePlan'])->name('content.plans.update');
    Route::delete('/content/plans/{plan}', [App\Http\Controllers\Admin\ContentController::class, 'destroyPlan'])->name('content.plans.destroy');
    Route::get('/content/features', [App\Http\Controllers\Admin\ContentController::class, 'features'])->name('content.features');
    Route::post('/content/features', [App\Http\Controllers\Admin\ContentController::class, 'storeFeature'])->name('content.features.store');
    Route::patch('/content/features/{feature}', [App\Http\Controllers\Admin\ContentController::class, 'updateFeature'])->name('content.features.update');
    Route::delete('/content/features/{feature}', [App\Http\Controllers\Admin\ContentController::class, 'destroyFeature'])->name('content.features.destroy');

    Route::get('/settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
});
