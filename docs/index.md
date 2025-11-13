# Socialite Slim Documentation

Welcome to the Socialite Slim documentation. This guide will help you get started with integrating OAuth authentication into your Laravel application using our lightweight package.

## Table of Contents

- [Installation](#installation)
- [Configuration](#configuration)
- [Basic Usage](#basic-usage)
- [OAuth Connected Users](#oauth-connected-users)
- [Supported Providers](#supported-providers)
- [Advanced Configuration](#advanced-configuration)
- [API Reference](#api-reference)
- [Troubleshooting](#troubleshooting)
- [Contributing](#contributing)

## Installation

To install Socialite Slim, simply run:

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

After installing the Socialite Slim library, register the service provider in your `config/app.php` configuration file:

```php
'providers' => [
    // Other service providers...

    Saeedvir\SocialiteSlim\SocialiteServiceProvider::class,
],
```

Also, add the facades to the `aliases` array in your `config/app.php` configuration file:

```php
'aliases' => [
    // Other aliases...

    'Socialite' => Saeedvir\SocialiteSlim\Facades\Socialite::class,
    'OAuth' => Saeedvir\SocialiteSlim\Facades\OAuth::class,
],
```

Add your OAuth credentials to `config/services.php`:

```php
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
```

## Basic Usage

```php
<?php

namespace App\Http\Controllers\Auth;

use Saeedvir\SocialiteSlim\Facades\Socialite;

class AuthController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();

        // $user->token
    }
}
```

## OAuth Connected Users

To use the OAuth connected users feature, add the trait to your User model:

```php
<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Saeedvir\SocialiteSlim\Traits\HasOAuthConnections;

class User extends Authenticatable
{
    use HasOAuthConnections;
    
    // ... rest of your model
}
```

Then you can use the OAuth facade to manage connections:

```php
use Saeedvir\SocialiteSlim\Facades\OAuth;

// Find or create an OAuth connected user
$connectedUser = OAuth::findOrCreateOauthUser($provider, $providerId, $userData);

// Connect an OAuth user to an existing user account
OAuth::connectToUser($oauthUser, $user);

// Get user by OAuth provider and ID
$oauthUser = OAuth::getOauthUser($provider, $providerId);

// Check if user has OAuth connection for a specific provider
$hasConnection = OAuth::userHasOauthConnection($user, $provider);
```

## Supported Providers

Socialite Slim currently supports the following OAuth providers:

- GitHub
- Google
- Telegram

## Advanced Configuration

You can publish the configuration file to customize the package behavior:

```bash
php artisan vendor:publish --provider="Saeedvir\SocialiteSlim\SocialiteServiceProvider" --tag="socialite-config"
```

This will create a `config/socialite.php` file where you can:

- Specify which providers to enable
- Configure provider settings
- Set the user model for OAuth connections

## API Reference

For detailed information about the available methods and classes, please refer to the [API Reference](api.md).

## Troubleshooting

If you encounter issues, please check:

1. Ensure your OAuth credentials are correctly configured
2. Verify that you've published and run the migrations
3. Check that the service provider is registered
4. Make sure you're using the correct redirect URLs

## Contributing

Thank you for considering contributing to Socialite Slim! Please see our [Contributing Guide](../CONTRIBUTING.md) for more information.

## Security

If you discover any security related issues, please email saeed.es91@gmail.com instead of using the issue tracker. Please see our [Security Policy](../SECURITY.md) for more information.