<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\ToolUsageController;
use App\Http\Controllers\Api\CodeConverterController;
use App\Http\Controllers\Api\AiToolController;
use Illuminate\Support\Facades\Route;

// --- PUBLIC HOME (landing page with all tools) ---
Route::get('/', [ToolController::class, 'home'])->name('home');

// --- TOOL ROUTES (public, SEO-friendly URLs) ---
Route::get('/tool/code-translator',      [ToolController::class, 'universalConverter'])->name('tool.universal');
Route::get('/tool/language-translator',  [ToolController::class, 'languageTranslator'])->name('tool.language');
Route::get('/tool/database-converter',   [ToolController::class, 'databaseConverter'])->name('tool.database');
Route::get('/tool/dictionary',           [ToolController::class, 'dictionary'])->name('tool.dictionary');

// --- AI API ENDPOINTS ---
Route::post('/api/tool-usage',  [ToolUsageController::class, 'store'])->name('api.tool-usage');
Route::post('/api/code/convert', [CodeConverterController::class, 'convert'])->name('api.code.convert');
Route::post('/api/ai-tool',      [AiToolController::class, 'handle'])->name('api.ai-tool');

// --- AUTHENTICATED ROUTES ---
Route::middleware('auth')->group(function () {
    Route::get('/history', [ToolController::class, 'history'])->name('history');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- ADMIN ONLY ---
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
});

require __DIR__.'/auth.php';
