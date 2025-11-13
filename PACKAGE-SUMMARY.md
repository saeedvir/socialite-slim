# Socialite Slim Package Summary

## Overview

Socialite Slim is a lightweight, optimized version of Laravel Socialite that focuses on the most commonly used OAuth providers: Google, GitHub, and Telegram. This package was created and maintained by saeedvir (saeed.es91@gmail.com).

## Key Features

1. **Lightweight**: Removed unused providers and dependencies to reduce package size
2. **Focused**: Only includes Google, GitHub, and Telegram providers
3. **Easy Configuration**: Simple configuration file for quick setup
4. **Well Documented**: Comprehensive usage guide and examples
5. **Extensible**: Easy to extend with custom providers if needed

## Package Structure

```
socialite-slim/
├── config/
│   └── socialite.php
├── examples/
│   ├── SocialiteController.php
│   └── routes.php
├── src/
│   ├── Contracts/
│   ├── Exceptions/
│   ├── Facades/
│   ├── Two/
│   │   ├── AbstractProvider.php
│   │   ├── GithubProvider.php
│   │   ├── GoogleProvider.php
│   │   ├── ProviderInterface.php
│   │   ├── TelegramProvider.php
│   │   ├── Token.php
│   │   └── User.php
│   ├── AbstractUser.php
│   ├── Socialite.php
│   ├── SocialiteManager.php
│   └── SocialiteServiceProvider.php
├── CHANGELOG.md
├── composer.json
├── LICENSE
├── LICENSE.md
├── PACKAGE-SUMMARY.md
├── README.md
├── USAGE.md
```

## Installation

```bash
composer require saeedvir/socialite-slim
```

## Configuration

1. Publish the configuration file:
   ```bash
   php artisan vendor:publish --provider="Laravel\Socialite\SocialiteServiceProvider" --tag="socialite-config"
   ```

2. Add your provider credentials to your `.env` file:
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

## Usage

See the [USAGE.md](USAGE.md) file for detailed usage instructions.

## Author

- **Name**: saeedvir
- **Email**: saeed.es91@gmail.com
- **GitHub**: https://github.com/saeedvir
- **Package Repository**: https://github.com/saeedvir/socialite-slim

## License

This package is open-sourced software licensed under the [MIT license](LICENSE.md).