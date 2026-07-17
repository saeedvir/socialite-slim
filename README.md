<p align="center"><img width="337" height="66" src="/art/logo.svg" alt="Logo Laravel Socialite"></p>

<p align="center">
<a href="https://github.com/saeedvir/socialite-slim/actions"><img src="https://github.com/saeedvir/socialite-slim/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/saeedvir/socialite-slim"><img src="https://img.shields.io/packagist/dt/saeedvir/socialite-slim" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/saeedvir/socialite-slim"><img src="https://img.shields.io/packagist/v/saeedvir/socialite-slim" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/saeedvir/socialite-slim"><img src="https://img.shields.io/packagist/l/saeedvir/socialite-slim" alt="License"></a>
</p>

## Introduction

Laravel Socialite Slim provides a lightweight, expressive, fluent interface to OAuth authentication with Google, GitHub, and Telegram.

## What's New in v5.0

- ✅ **Laravel 13 Compatibility** - Updated dependencies to support latest Laravel versions
- 🔒 **Security Improvements** - Implemented timing-safe state comparison using `hash_equals()`
- 🧪 **Enhanced Testing** - Added `FakeProvider` and `SocialiteFake` for easy testing
- 📦 **Slim Distribution** - Removed non-essential files to keep package lightweight

## Supported Providers

- Google
- GitHub
- Telegram

## OAuth Connected Users Feature

This package includes a complete OAuth connected users system that allows you to track and manage OAuth connections for your users. For detailed documentation, please refer to the documentation in the repository (docs/ folder).

## Installation

```bash
composer require saeedvir/socialite-slim
```

### Publish Migrations

To use the OAuth connected users feature, publish the migrations:

```bash
php artisan vendor:publish --provider="Saeedvir\SocialiteSlim\SocialiteServiceProvider" --tag="socialite-migrations"
```

Then run the migrations:

```bash
php artisan migrate
```

## Configuration

After publishing the service provider, the package will automatically load its configuration from `config/socialite.php`. You can publish this configuration file with:

```bash
php artisan vendor:publish --provider="Saeedvir\SocialiteSlim\SocialiteServiceProvider" --tag="socialite-config"
```

Add your credentials to your `.env` file:

```dotenv
GITHUB_CLIENT_ID=your_github_client_id
GITHUB_CLIENT_SECRET=your_github_client_secret
GITHUB_REDIRECT_URI=/auth/github/callback

GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI=/auth/google/callback

TELEGRAM_CLIENT_ID=your_telegram_bot_token
TELEGRAM_CLIENT_SECRET=your_telegram_bot_token
TELEGRAM_REDIRECT_URI=/auth/telegram/callback
```

## Basic Usage

```php
use Saeedvir\SocialiteSlim\Socialite;

// Redirect user to OAuth provider
return Socialite::driver('google')->redirect();

// Get user information from provider callback
$user = Socialite::driver('google')->user();

// Get specific user data
$user->getId();
$user->getNickname();
$user->getName();
$user->getEmail();
$user->getAvatar();
```

## OAuth Connected Users Usage

```php
use Saeedvir\SocialiteSlim\Facades\OAuth;

// Find or create an OAuth connected user
$oauthUser = OAuth::findOrCreateOauthUser(
    'google',
    $user->getId(),
    [
        'access_token' => $user->token,
        'refresh_token' => $user->refreshToken,
        'expires_in' => $user->expiresIn,
        'name' => $user->name,
        'email' => $user->email,
        'avatar' => $user->avatar
    ]
);

// Check if user has OAuth connection
$hasConnection = OAuth::userHasOauthConnection($userModel, 'google');

// Get OAuth user by provider and ID
$storedOauthUser = OAuth::getOauthUser('google', $googleUserId);
```

## Advanced Features

### Scopes and Parameters

```php
// Add additional scopes
Socialite::driver('google')
    ->scopes(['openid', 'profile', 'email', 'https://www.googleapis.com/auth/calendar'])
    ->redirect();

// Add custom parameters
Socialite::driver('google')
    ->with(['hd' => 'example.com']) // Google Apps domain restriction
    ->redirect();
```

### Testing

The package includes testing utilities for easy mocking:

```php
use Saeedvir\SocialiteSlim\Socialite;
use Saeedvir\SocialiteSlim\Testing\SocialiteFake;

// In your tests:
Socialite::fake();

// Define a fake user for GitHub
Socialite::fake('github', (object) [
    'id' => '12345',
    'nickname' => 'githubuser',
    'name' => 'GitHub User',
    'email' => 'user@example.com',
]);

// Now Socialite::driver('github')->user() will return the fake user above
```

## Security

If you discover any security-related issues, please email security@saeedvir.com instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
