#!/bin/bash

# This script helps set up the development environment for Socialite Slim

# Check if composer is installed
if ! command -v composer &> /dev/null
then
    echo "Composer could not be found. Please install Composer first."
    exit 1
fi

# Install dependencies
echo "Installing PHP dependencies..."
composer install

# Check if npm is installed
if command -v npm &> /dev/null
then
    echo "Installing JavaScript dependencies..."
    npm install
else
    echo "npm not found. Skipping JavaScript dependency installation."
fi

# Copy environment file if it doesn't exist
if [ ! -f .env ]; then
    echo "Creating .env file..."
    cp .env.example .env 2>/dev/null || echo "No .env.example file found."
fi

# Generate application key if using Laravel
if command -v php &> /dev/null && [ -f "artisan" ]; then
    echo "Generating application key..."
    php artisan key:generate 2>/dev/null || echo "Could not generate application key."
fi

echo "Development environment setup complete!"
echo "Remember to:"
echo "1. Configure your OAuth credentials in config/services.php"
echo "2. Run migrations if needed: php artisan migrate"
echo "3. Start the development server: php artisan serve"