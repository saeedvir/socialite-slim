<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Socialite Providers
    |--------------------------------------------------------------------------
    |
    | Here you may specify the providers that you want to enable for your
    | application. You can enable multiple providers at once.
    |
    */

    'providers' => [
        'github',
        'google',
        'telegram',
    ],

    /*
    |--------------------------------------------------------------------------
    | Socialite Driver Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure the settings for each socialite driver.
    |
    */

    'github' => [
        'client_id' => env('GITHUB_CLIENT_ID'),
        'client_secret' => env('GITHUB_CLIENT_SECRET'),
        'redirect' => env('GITHUB_REDIRECT_URI', '/auth/github/callback'),
    ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT_URI', '/auth/google/callback'),
    ],

    'telegram' => [
        'client_id' => env('TELEGRAM_CLIENT_ID'),
        'client_secret' => env('TELEGRAM_CLIENT_SECRET'),
        'redirect' => env('TELEGRAM_REDIRECT_URI', '/auth/telegram/callback'),
    ],

    /*
    |--------------------------------------------------------------------------
    | User Model
    |--------------------------------------------------------------------------
    |
    | Here you may specify the user model that should be used for OAuth connections.
    |
    */

    'user_model' => App\Models\User::class,

];