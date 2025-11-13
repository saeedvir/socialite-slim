# Socialite Slim Usage Guide

## Installation

```bash
composer require saeedvir/socialite-slim
```

## Configuration

After installing the package, you need to publish the configuration file:

```bash
php artisan vendor:publish --provider="Saeedvir\SocialiteSlim\SocialiteServiceProvider" --tag="socialite-config"
```

This will create a `config/socialite.php` file where you can configure your providers.

You also need to add your provider credentials to your `.env` file:

```env
# GitHub
GITHUB_CLIENT_ID=your_github_client_id
GITHUB_CLIENT_SECRET=your_github_client_secret
GITHUB_REDIRECT_URI=/auth/github/callback

# Google
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI=/auth/google/callback

# Telegram
TELEGRAM_CLIENT_ID=your_telegram_client_id
TELEGRAM_CLIENT_SECRET=your_telegram_client_secret
TELEGRAM_REDIRECT_URI=/auth/telegram/callback
```

## Available Providers

The Socialite Slim package supports the following providers:

1. GitHub
2. Google
3. Telegram

## Usage

### Controller Implementation

```php
<?php

namespace App\Http\Controllers\Auth;

use Saeedvir\SocialiteSlim\Facades\Socialite;

class AuthController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from the provider.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
            
            // Process the user data
            $userId = $user->getId();
            $userName = $user->getName();
            $userEmail = $user->getEmail();
            $userAvatar = $user->getAvatar();
            $userNickname = $user->getNickname();
            
            // You can also access the raw user data
            $rawUser = $user->getRaw();
            
            // Store the user in your database or log them in
            // ...
            
            return redirect()->route('dashboard')->with('success', 'Successfully authenticated!');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Failed to authenticate.');
        }
    }
}
```

### Route Configuration

```php
Route::group(['middleware' => ['web']], function () {
    // GitHub Authentication Routes
    Route::get('/auth/github/redirect', [AuthController::class, 'redirectToProvider'])
        ->name('auth.github.redirect')->defaults('provider', 'github');
        
    Route::get('/auth/github/callback', [AuthController::class, 'handleProviderCallback'])
        ->name('auth.github.callback')->defaults('provider', 'github');

    // Google Authentication Routes
    Route::get('/auth/google/redirect', [AuthController::class, 'redirectToProvider'])
        ->name('auth.google.redirect')->defaults('provider', 'google');
        
    Route::get('/auth/google/callback', [AuthController::class, 'handleProviderCallback'])
        ->name('auth.google.callback')->defaults('provider', 'google');

    // Telegram Authentication Routes
    Route::get('/auth/telegram/redirect', [AuthController::class, 'redirectToProvider'])
        ->name('auth.telegram.redirect')->defaults('provider', 'telegram');
        
    Route::get('/auth/telegram/callback', [AuthController::class, 'handleProviderCallback'])
        ->name('auth.telegram.callback')->defaults('provider', 'telegram');
});
```

### Using the Facade

You can also use the Socialite facade directly:

```php
use Laravel\Socialite\Facades\Socialite;

// Get a specific provider
$github = Socialite::driver('github');

// Redirect to the provider
return $github->redirect();

// Get the user from the provider
$user = Socialite::driver('github')->user();

// Access user properties
echo $user->getId();
echo $user->getName();
echo $user->getEmail();
echo $user->getAvatar();
echo $user->getNickname();
```

## Provider Specific Information

### GitHub

GitHub uses OAuth 2.0 for authentication. You need to create an OAuth application in your GitHub settings to get the client ID and secret.

### Google

Google uses OAuth 2.0 for authentication. You need to create credentials in the Google Cloud Console to get the client ID and secret.

### Telegram

Telegram uses a custom OAuth implementation. You need to create a bot and get the bot token from the BotFather.

## Error Handling

The package throws exceptions when authentication fails. You should always wrap your Socialite calls in try-catch blocks:

```php
try {
    $user = Socialite::driver('github')->user();
} catch (\Saeedvir\SocialiteSlim\Exceptions\DriverMissingConfigurationException $e) {
    // Handle missing configuration
} catch (\Exception $e) {
    // Handle other exceptions
}
```

## Customization

You can extend the Socialite manager to add custom providers or modify existing ones:

```php
use Saeedvir\SocialiteSlim\Facades\Socialite;

Socialite::extend('custom_provider', function ($app) {
    // Return your custom provider instance
});
```