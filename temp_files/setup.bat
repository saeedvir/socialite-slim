@echo off
REM This script helps set up the development environment for Socialite Slim

REM Check if composer is installed
where composer >nul 2>&1
if %errorlevel% neq 0 (
    echo Composer could not be found. Please install Composer first.
    exit /b 1
)

REM Install dependencies
echo Installing PHP dependencies...
composer install

REM Check if npm is installed
where npm >nul 2>&1
if %errorlevel% equ 0 (
    echo Installing JavaScript dependencies...
    npm install
) else (
    echo npm not found. Skipping JavaScript dependency installation.
)

REM Copy environment file if it doesn't exist
if not exist .env (
    echo Creating .env file...
    if exist .env.example (
        copy .env.example .env
    ) else (
        echo No .env.example file found.
    )
)

REM Generate application key if using Laravel
where php >nul 2>&1
if %errorlevel% equ 0 (
    if exist artisan (
        echo Generating application key...
        php artisan key:generate 2>nul || echo Could not generate application key.
    )
)

echo Development environment setup complete!
echo Remember to:
echo 1. Configure your OAuth credentials in config/services.php
echo 2. Run migrations if needed: php artisan migrate
echo 3. Start the development server: php artisan serve

pause