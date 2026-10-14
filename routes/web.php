<?php

use App\Http\Controllers\Admin\InformationController as AdminInformationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\InformationController as UserInformationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Sistem Informasi Sekolah (Sekolah Inspirasi)
|--------------------------------------------------------------------------
*/

// Public Landing Page (Beranda Sekolah Inspirasi.png)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication Routes (Masuk portal sekolah.png)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// User Routes (Role: user / admin)
Route::middleware(['auth'])->prefix('portal')->name('user.')->group(function () {
    Route::get('/informasi', [UserInformationController::class, 'index'])->name('information.index');
    Route::get('/informasi/{information}', [UserInformationController::class, 'show'])->name('information.show');
});

// Admin Routes (Role: admin) - Protected with 'role:admin'
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminInformationController::class, 'dashboard'])->name('dashboard');
    Route::resource('information', AdminInformationController::class);
});
