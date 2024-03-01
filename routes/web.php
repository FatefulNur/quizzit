<?php

use App\Http\Controllers\WebhookController;
use App\Livewire\User\Billings\Index as BillingIndex;
use App\Livewire\User\Billings\Plan as BillingPlan;
use App\Livewire\User\Billings\Subscribe as BillingSubscribe;
use App\Livewire\User\Quizzes\Create;
use App\Livewire\User\Quizzes\Edit;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Livewire\User\Quizzes\Show as QuizShow;
use App\Http\Controllers\User\ProfileController;
use App\Livewire\User\Quizzes\Index as QuizIndex;
use App\Http\Controllers\User\DashboardController;
use App\Livewire\User\Responses\Show as ResponseShow;
use App\Livewire\User\Responses\Index as ResponseIndex;

require __DIR__ . '/auth.php';

Route::get('/', HomeController::class)->name('home');

Route::middleware([/* 'verified', */ 'auth'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/profile', ProfileController::class)->name('profile');

    Route::get('/quizzes/create', Create::class)->name('quizzes.create');
    Route::get('/quizzes/{quiz}/edit', Edit::class)->name('quizzes.edit');
    Route::get('/quizzes', QuizIndex::class)->name('quizzes.index');
    Route::get('/quizzes/{quiz}', QuizShow::class)->name('quizzes.show')
        ->withoutMiddleware('auth')
        ->middleware('intercept.expired')
        ->middleware('intercept.private')
        ->middleware('intercept.timeout');
    Route::get('/responses', ResponseIndex::class)->name('responses.index');
    Route::get('/responses/{response}', ResponseShow::class)->name('responses.show')
        ->withoutMiddleware('auth');
    Route::get('billings', BillingIndex::class)->name('billings.index');
    Route::get('billings/plan', BillingPlan::class)->name('billings.plan');
    Route::get('billings/subscribe', BillingSubscribe::class)->name('billings.subscribe');
});

Route::prefix('webhook')->name('webhook.')->group(function () {
    Route::post('/subscriptions', [WebhookController::class, 'storeSubscription'])->name('subscriptions.store');
});

Route::prefix('notify')->name('notify.')->group(function () {
    Route::view('/responses/{response}/show', 'notify.responses.show')->name('responses.show');
    Route::view('/quizzes/show-private', 'notify.quizzes.show-private')->name('quizzes.show_private');
    Route::view('/quizzes/show-unavailable', 'notify.quizzes.show-unavailable')->name('quizzes.show_unavailable');
    Route::view('/quizzes/show-timeout', 'notify.quizzes.show-timeout')->name('quizzes.show_timeout');
    Route::view('/plans/create-quiz', 'notify.plans.create-quiz')->name('plans.create_quiz');
});
