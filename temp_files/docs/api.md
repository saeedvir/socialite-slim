# API Reference

This document provides detailed information about the classes, methods, and interfaces available in Socialite Slim.

## Socialite Facade

The Socialite facade provides access to OAuth providers.

### Methods

#### driver(string $driver)
Get a driver instance.

```php
Socialite::driver('github');
```

#### with(array $parameters)
Set additional parameters for the request.

```php
Socialite::driver('github')->with(['foo' => 'bar']);
```

#### scopes(array $scopes)
Set the scopes for the request.

```php
Socialite::driver('github')->scopes(['user:email']);
```

#### redirect()
Redirect to the OAuth provider.

```php
return Socialite::driver('github')->redirect();
```

#### user()
Get the user from the OAuth provider.

```php
$user = Socialite::driver('github')->user();
```

## OAuth Facade

The OAuth facade provides methods for managing OAuth connected users.

### Methods

#### findOrCreateOauthUser(string $provider, string $providerId, array $userData)
Find or create an OAuth connected user.

```php
$connectedUser = OAuth::findOrCreateOauthUser($provider, $providerId, $userData);
```

#### connectToUser(mixed $oauthUser, mixed $user)
Connect an OAuth user to an existing user account.

```php
OAuth::connectToUser($oauthUser, $user);
```

#### getOauthUser(string $provider, string $providerId)
Get user by OAuth provider and ID.

```php
$oauthUser = OAuth::getOauthUser($provider, $providerId);
```

#### userHasOauthConnection(mixed $user, string $provider)
Check if user has OAuth connection for a specific provider.

```php
$hasConnection = OAuth::userHasOauthConnection($user, $provider);
```

## HasOAuthConnections Trait

The HasOAuthConnections trait adds OAuth connection functionality to the User model.

### Methods

#### oauthConnections()
Get all OAuth connections for a user.

```php
$connections = $user->oauthConnections;
```

#### hasOauthConnection(string $provider)
Check if user has OAuth connection for a specific provider.

```php
$hasConnection = $user->hasOauthConnection('github');
```

#### getOauthConnection(string $provider)
Get OAuth connection for a specific provider.

```php
$oauthConnection = $user->getOauthConnection('github');
```

#### connectOauthAccount(mixed $oauthUser)
Connect an OAuth account to this user.

```php
$user->connectOauthAccount($oauthUser);
```

## SocialiteManager Class

The SocialiteManager class is responsible for creating and managing OAuth provider instances.

### Methods

#### createGithubDriver()
Create a GitHub driver instance.

#### createGoogleDriver()
Create a Google driver instance.

#### createTelegramDriver()
Create a Telegram driver instance.

#### getDefaultDriver()
Get the default driver name.

## OauthConnectionService Class

The OauthConnectionService class provides the underlying implementation for OAuth connection management.

### Methods

#### findOrCreateOauthUser(string $provider, string $providerId, array $userData)
Find or create an OAuth connected user.

#### connectToUser(mixed $oauthUser, mixed $user)
Connect an OAuth user to an existing user account.

#### getOauthUser(string $provider, string $providerId)
Get user by OAuth provider and ID.

#### userHasOauthConnection(mixed $user, string $provider)
Check if user has OAuth connection for a specific provider.

## Models

### OauthConnectedUser

The OauthConnectedUser model represents an OAuth connection in the database.

#### Properties

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

## Exceptions

### DriverMissingConfigurationException

Thrown when a driver is missing configuration.

## Interfaces

### Factory

The Factory interface defines the contract for creating Socialite providers.

### Provider

The Provider interface defines the contract for OAuth providers.

### User

The User interface defines the contract for OAuth user objects.