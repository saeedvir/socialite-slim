# OAuth Connected Users Feature

This package includes a complete OAuth connected users system that allows you to track and manage OAuth connections for your users.

## Features

- Store OAuth connections with provider information
- Link OAuth accounts to existing user accounts
- Handle OAuth connections for new users
- Manage access tokens and refresh tokens
- Track token expiration dates
- Easy-to-use traits and services

## Installation

After installing the package, publish the migrations:

```bash
php artisan vendor:publish --provider="Saeedvir\SocialiteSlim\SocialiteServiceProvider" --tag="socialite-migrations"
```

Run the migrations:

```bash
php artisan migrate
```

## Usage

### 1. Add the Trait to Your User Model

Add the `HasOAuthConnections` trait to your User model:

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

### 2. Using the OAuth Facade

You can use the OAuth facade to manage OAuth connections:

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

### 3. Using the Trait Methods

If you've added the trait to your User model, you can use these methods:

```php
// Get all OAuth connections for a user
$connections = $user->oauthConnections;

// Check if user has OAuth connection for a specific provider
$hasConnection = $user->hasOauthConnection('github');

// Get OAuth connection for a specific provider
$oauthConnection = $user->getOauthConnection('github');

// Connect an OAuth account to this user
$user->connectOauthAccount($oauthUser);
```

### 4. Example Controller Implementation

See the [OAuthController.php](examples/OAuthController.php) file for a complete example implementation.

## Configuration

You can specify the user model to be used in the `config/socialite.php` file:

```php
'user_model' => App\Models\User::class,
```

## Database Structure

The package creates an `oauth_connected_users` table with the following structure:

- `id` - Primary key
- `user_id` - Foreign key to users table (nullable)
- `provider` - OAuth provider name (e.g., 'github', 'google')
- `provider_id` - User ID from the OAuth provider
- `email` - User email from OAuth provider
- `name` - User name from OAuth provider
- `nickname` - User nickname/username from OAuth provider
- `avatar` - Avatar URL from OAuth provider
- `access_token` - OAuth access token
- `refresh_token` - OAuth refresh token (nullable)
- `expires_at` - Token expiration timestamp (nullable)
- `created_at` - Record creation timestamp
- `updated_at` - Record update timestamp

## Security

The package securely stores OAuth tokens and provides methods to check token expiration.