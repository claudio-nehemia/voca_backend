<?php

use App\Http\Controllers\Api\MobileAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/mobile/login', [MobileAuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [MobileAuthController::class, 'user']);
    Route::get('/leaderboard', [MobileAuthController::class, 'leaderboard']);
    Route::post('/mobile/logout', [MobileAuthController::class, 'logout']);

    // Vocabulary Routes
    Route::get('/vocabulary/themes', [\App\Http\Controllers\Api\VocabularyController::class, 'themes']);
    Route::get('/vocabulary/themes/{id}', [\App\Http\Controllers\Api\VocabularyController::class, 'vocabularies']);
    Route::post('/vocabulary/{id}/complete', [\App\Http\Controllers\Api\VocabularyController::class, 'complete']);
    Route::get('/vocabulary/continue-learning', [\App\Http\Controllers\Api\VocabularyController::class, 'continueLearning']);

    Route::get('/writings', [\App\Http\Controllers\Api\WritingController::class, 'index']);
    Route::get('/writings/{id}', [\App\Http\Controllers\Api\WritingController::class, 'show']);
    Route::post('/writings/{id}/submit', [\App\Http\Controllers\Api\WritingController::class, 'submit']);

    Route::get('/speakings', [\App\Http\Controllers\Api\SpeakingController::class, 'index']);
    Route::get('/speakings/{id}', [\App\Http\Controllers\Api\SpeakingController::class, 'show']);
    Route::post('/speakings/{id}/submit', [\App\Http\Controllers\Api\SpeakingController::class, 'submit']);

    Route::get('/materials', [\App\Http\Controllers\Api\MaterialController::class, 'index']);
    Route::get('/exercises/stats', [\App\Http\Controllers\Api\ExerciseController::class, 'stats']);
});


