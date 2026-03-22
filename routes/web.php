<?php

use App\Http\Controllers\VocabularyController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.post');
});

// Auth & Admin Routes
Route::middleware(['auth', 'admin'])->group(function () { 
    Route::get('/', function () {
        return redirect()->route('vocabularies.index');
    });

    Route::resource('vocabularies', VocabularyController::class);
    Route::resource('writings', \App\Http\Controllers\WritingController::class);
    Route::resource('speakings', \App\Http\Controllers\SpeakingController::class);
    Route::resource('materials', \App\Http\Controllers\MaterialController::class);
    Route::resource('admin-users', \App\Http\Controllers\AdminUserController::class);
    Route::get('mobile-users/requests', [\App\Http\Controllers\MobileUserController::class, 'activationRequests'])->name('mobile-users.requests');
    Route::post('mobile-users/{user}/activate', [\App\Http\Controllers\MobileUserController::class, 'activate'])->name('mobile-users.activate');
    Route::resource('mobile-users', \App\Http\Controllers\MobileUserController::class);
    Route::get('top-students', [\App\Http\Controllers\LeaderboardController::class, 'index'])->name('top-students.index');
    Route::resource('achievements', \App\Http\Controllers\AchievementController::class)->except(['create', 'show']);
    
    Route::get('dashboard', function() {
        return redirect()->route('vocabularies.index');
    })->name('dashboard');

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

// Fallback redirect
Route::get('/', function () {
    return redirect()->route('login');
});
