<?php

use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\QuizController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\DashboardController;

require __DIR__ . '/auth.php';

Route::get('/', HomeController::class)->name('home');

Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/profile', ProfileController::class)->name('profile');
    Route::resource('quizzes', QuizController::class)->except('index');
});
