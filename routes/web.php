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

