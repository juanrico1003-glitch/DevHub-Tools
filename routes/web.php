<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\Api\ToolUsageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ToolController::class, 'index'])->name('home');
Route::get('/dashboard', [ToolController::class, 'index'])->name('dashboard');

Route::get('/tool/sql-to-eloquent', [ToolController::class, 'sqlToEloquent'])->name('tool.sql-to-eloquent');
Route::get('/tool/json-formatter', [ToolController::class, 'jsonFormatter'])->name('tool.json-formatter');
Route::get('/tool/route-generator', [ToolController::class, 'routeGenerator'])->name('tool.route-generator');

Route::post('/api/tool-usage', [ToolUsageController::class, 'store'])->name('api.tool-usage');

Route::middleware('auth')->group(function () {
    Route::get('/history', [ToolController::class, 'history'])->name('history');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
