<?php

namespace Saeedvir\SocialiteSlim\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OauthConnectedUser extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'provider',
        'provider_id',
        'email',
        'name',
        'nickname',
        'avatar',
        'access_token',
        'refresh_token',
        'expires_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'expires_at' => 'datetime',
    ];

    /**
     * Get the user that owns this OAuth connection.
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * Scope a query to only include records for a specific provider.
     */
    public function scopeProvider($query, $provider)
    {
        return $query->where('provider', $provider);
    }

    /**
     * Scope a query to only include records for a specific provider ID.
     */
    public function scopeProviderId($query, $providerId)
    {
        return $query->where('provider_id', $providerId);
    }

    /**
     * Check if the OAuth token has expired.
     */
    public function isTokenExpired()
    {
        return $this->expires_at && $this->expires_at->isPast();
    }
}