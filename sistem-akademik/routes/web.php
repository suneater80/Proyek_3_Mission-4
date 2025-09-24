<?php

use App\Http\Middleware\CheckRole;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin', function () {
    return 'Hanya untuk admin';
})->middleware([CheckRole::class, 'admin']);

require __DIR__.'/auth.php';

// Route untuk Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/courses', [App\Http\Controllers\Admin\CourseController::class, 'index'])->name('admin.courses.index');
    Route::get('/admin/courses/create', [App\Http\Controllers\Admin\CourseController::class, 'create'])->name('admin.courses.create');
    Route::post('/admin/courses', [App\Http\Controllers\Admin\CourseController::class, 'store'])->name('admin.courses.store');
    Route::delete('/admin/courses/{id}', [App\Http\Controllers\Admin\CourseController::class, 'destroy'])->name('admin.courses.destroy');
});

// Route untuk Mahasiswa
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/student/courses', [App\Http\Controllers\Student\CourseController::class, 'index'])->name('student.courses.index');
    Route::post('/student/courses/{id}/enroll', [App\Http\Controllers\Student\CourseController::class, 'enroll'])->name('student.courses.enroll');
});