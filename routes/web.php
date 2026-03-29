<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\ToolUsageController;
use Illuminate\Support\Facades\Route;

// --- PUBLIC ROUTES ---
// Home = Universal Translator (accessible to everyone)
Route::get('/', [ToolController::class, 'universalConverter'])->name('home');

// API endpoints for logging tool usage and AI conversion
Route::post('/api/tool-usage', [ToolUsageController::class, 'store'])->name('api.tool-usage');
Route::post('/api/code/convert', [\App\Http\Controllers\Api\CodeConverterController::class, 'convert'])->name('api.code.convert');

// --- AUTHENTICATED ROUTES ---
Route::middleware('auth')->group(function () {
    Route::get('/history', [ToolController::class, 'history'])->name('history');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- ADMIN ONLY ROUTES ---
// Only accessible to juanrico1003@gmail.com
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
});

require __DIR__.'/auth.php';
