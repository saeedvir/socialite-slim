<?php

use Illuminate\Support\Facades\Route;
use Saeedvir\SocialiteSlim\Examples\SocialiteController;

/*
|--------------------------------------------------------------------------
| Socialite Routes Example
|--------------------------------------------------------------------------
|
| These routes are examples of how to use the Socialite package.
|
*/

Route::group(['middleware' => ['web']], function () {
    // GitHub Authentication Routes
    Route::get('/auth/github/redirect', [SocialiteController::class, 'redirectToGithub'])
        ->name('auth.github.redirect');
        
    Route::get('/auth/github/callback', [SocialiteController::class, 'handleGithubCallback'])
        ->name('auth.github.callback');

    // Google Authentication Routes
    Route::get('/auth/google/redirect', [SocialiteController::class, 'redirectToGoogle'])
        ->name('auth.google.redirect');
        
    Route::get('/auth/google/callback', [SocialiteController::class, 'handleGoogleCallback'])
        ->name('auth.google.callback');

    // Telegram Authentication Routes
    Route::get('/auth/telegram/redirect', [SocialiteController::class, 'redirectToTelegram'])
        ->name('auth.telegram.redirect');
        
    Route::get('/auth/telegram/callback', [SocialiteController::class, 'handleTelegramCallback'])
        ->name('auth.telegram.callback');
});