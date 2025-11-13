# Socialite Slim Package Summary

## Overview

Socialite Slim is a lightweight, optimized version of Laravel Socialite that focuses on the most commonly used OAuth providers: Google, GitHub, and Telegram. This package was created and maintained by saeedvir (saeed.es91@gmail.com).

## Key Features

1. **Lightweight**: Removed unused providers and dependencies to reduce package size
2. **Focused**: Only includes Google, GitHub, and Telegram providers
3. **OAuth Connected Users**: Complete system for tracking and managing OAuth connections
4. **Easy Configuration**: Simple configuration file for quick setup
5. **Well Documented**: Comprehensive usage guide and examples
6. **Extensible**: Easy to extend with custom providers if needed
7. **Well Tested**: Includes PHPUnit tests and CI/CD workflows

## Package Structure

```
socialite-slim/
├── art/
│   └── logo.svg
├── config/
│   └── socialite.php
├── database/
│   └── migrations/
│       └── 2025_11_13_000001_create_oauth_connected_users_table.php
├── docs/
│   ├── api.md
│   └── index.md
├── examples/
│   ├── OAuthController.php
│   ├── SocialiteController.php
│   └── routes.php
├── src/
│   ├── Contracts/
│   ├── Exceptions/
│   ├── Facades/
│   ├── Models/
│   │   └── OauthConnectedUser.php
│   ├── Services/
│   │   └── OauthConnectionService.php
│   ├── Traits/
│   │   └── HasOAuthConnections.php
│   ├── Two/
│   │   ├── AbstractProvider.php
│   │   ├── GithubProvider.php
│   │   ├── GoogleProvider.php
│   │   ├── InvalidStateException.php
│   │   ├── ProviderInterface.php
│   │   ├── TelegramProvider.php
│   │   ├── Token.php
│   │   └── User.php
│   ├── AbstractUser.php
│   ├── Socialite.php
│   ├── SocialiteManager.php
│   └── SocialiteServiceProvider.php
├── tests/
│   ├── Feature/
│   ├── Unit/
│   │   └── SocialiteTest.php
│   └── TestCase.php
├── .github/
│   ├── ISSUE_TEMPLATE/
│   │   ├── bug_report.md
│   │   └── feature_request.md
│   ├── workflows/
│   │   ├── code-quality.yml
│   │   └── tests.yml
│   ├── FUNDING.yml
├── CHANGELOG.md
├── CODE_OF_CONDUCT.md
├── composer.json
├── CONTRIBUTING.md
├── ISSUE_TEMPLATE.md
├── LICENSE
├── LICENSE.md
├── OAUTH-FEATURE-SUMMARY.md
├── OAUTH-README.md
├── PACKAGE-SUMMARY.md
├── PULL_REQUEST_TEMPLATE.md
├── README.md
├── SECURITY.md
├── USAGE.md
├── phpunit.xml
├── setup.bat
└── setup.sh
```

## Installation

```bash
composer require saeedvir/socialite-slim
```

## Configuration

1. Publish the configuration file:
   ```bash
   php artisan vendor:publish --provider="Saeedvir\SocialiteSlim\SocialiteServiceProvider" --tag="socialite-config"
   ```

2. Publish the migrations for OAuth connected users:
   ```bash
   php artisan vendor:publish --provider="Saeedvir\SocialiteSlim\SocialiteServiceProvider" --tag="socialite-migrations"
   ```

3. Run the migrations:
   ```bash
   php artisan migrate
   ```

4. Add your provider credentials to your `.env` file:
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

## Documentation

- [Main Documentation](docs/index.md)
- [API Reference](docs/api.md)
- [OAuth Feature Documentation](OAUTH-README.md)

## Author

- **Name**: saeedvir
- **Email**: saeed.es91@gmail.com
- **GitHub**: https://github.com/saeedvir
- **Package Repository**: https://github.com/saeedvir/socialite-slim

## License

This package is open-sourced software licensed under the [MIT license](LICENSE.md).