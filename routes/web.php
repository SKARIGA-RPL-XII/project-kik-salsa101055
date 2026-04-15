<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

// ==================== AUTH ROUTES ====================
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==================== AUTHENTICATED ROUTES ====================
Route::middleware('auth')->group(function () {

    // ==================== ADMIN ROUTES ====================
    Route::prefix('admin')->name('admin.')->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // ===== PROFILE =====
        Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
        Route::put('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');

        // ===== KELOLA USER =====
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
        Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('users.update');
        Route::delete('/users/{id}', [AdminController::class, 'destroyUser'])->name('users.destroy');
        Route::post('/users/{id}/toggle-status', [AdminController::class, 'toggleStatus'])->name('users.toggleStatus');

        // ===== KELOLA TUGAS =====
        Route::get('/tasks', [AdminController::class, 'tasks'])->name('tasks');
        Route::post('/tasks', [AdminController::class, 'storeTask'])->name('tasks.store');
        Route::put('/tasks/{id}', [AdminController::class, 'updateTask'])->name('tasks.update');
        Route::delete('/tasks/{id}', [AdminController::class, 'destroyTask'])->name('tasks.destroy');

        // ===== REVIEW TUGAS =====
        Route::get('/review', [AdminController::class, 'review'])->name('review');
        Route::put('/review/{id}/approve', [AdminController::class, 'approveReport'])->name('review.approve');
        Route::put('/review/{id}/reject', [AdminController::class, 'rejectReport'])->name('review.reject');

        // ===== MONITORING =====
        Route::get('/monitoring', [AdminController::class, 'monitoring'])->name('monitoring');
    });

    // ==================== USER ROUTES ====================
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
        Route::post('/tasks/{pivotId}/status', [UserController::class, 'updateStatus'])->name('tasks.updateStatus');

        // === PROFILE & HISTORY ===
        Route::get('/profile', [UserController::class, 'profile'])->name('profile');
        Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
        Route::post('/profile/photo', [UserController::class, 'updatePhoto'])->name('profile.photo');
        Route::get('/history', [UserController::class, 'history'])->name('history');

        // === SUBMIT LAPORAN ===
        Route::post('/tasks/submit', [UserController::class, 'submitTask'])->name('tasks.submit');
    });
});