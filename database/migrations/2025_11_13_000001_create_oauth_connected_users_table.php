<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('oauth_connected_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // Nullable in case user doesn't exist yet
            $table->string('provider'); // e.g., 'github', 'google', 'telegram'
            $table->string('provider_id'); // The user's ID from the OAuth provider
            $table->string('email')->nullable(); // Email from OAuth provider
            $table->string('name')->nullable(); // Name from OAuth provider
            $table->string('nickname')->nullable(); // Nickname/username from OAuth provider
            $table->string('avatar')->nullable(); // Avatar URL from OAuth provider
            $table->text('access_token'); // Access token for API calls
            $table->text('refresh_token')->nullable(); // Refresh token if provided
            $table->timestamp('expires_at')->nullable(); // Token expiration time
            $table->timestamps();

            // Indexes for better performance
            $table->index(['provider', 'provider_id']);
            $table->index('user_id');
            $table->index('email');

            // Foreign key constraint to users table
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oauth_connected_users');
    }
};