<?php

namespace Saeedvir\SocialiteSlim\Services;

use saeedvir\SocialiteSlim\Models\OauthConnectedUser;
use Illuminate\Support\Facades\DB;

class OauthConnectionService
{
    /**
     * Find or create an OAuth connected user.
     *
     * @param string $provider
     * @param string $providerId
     * @param array $userData
     * @return OauthConnectedUser
     */
    public function findOrCreateOauthUser(string $provider, string $providerId, array $userData): OauthConnectedUser
    {
        return DB::transaction(function () use ($provider, $providerId, $userData) {
            // Try to find existing OAuth connection
            $oauthUser = OauthConnectedUser::provider($provider)->providerId($providerId)->first();
            
            if ($oauthUser) {
                // Update existing connection
                $oauthUser->update([
                    'access_token' => $userData['access_token'],
                    'refresh_token' => $userData['refresh_token'] ?? null,
                    'expires_at' => $userData['expires_at'] ?? null,
                    'name' => $userData['name'] ?? $oauthUser->name,
                    'email' => $userData['email'] ?? $oauthUser->email,
                    'avatar' => $userData['avatar'] ?? $oauthUser->avatar,
                ]);
                
                return $oauthUser;
            }
            
            // Create new OAuth connection
            $oauthUser = OauthConnectedUser::create([
                'provider' => $provider,
                'provider_id' => $providerId,
                'email' => $userData['email'] ?? null,
                'name' => $userData['name'] ?? null,
                'nickname' => $userData['nickname'] ?? null,
                'avatar' => $userData['avatar'] ?? null,
                'access_token' => $userData['access_token'],
                'refresh_token' => $userData['refresh_token'] ?? null,
                'expires_at' => $userData['expires_at'] ?? null,
            ]);
            
            // Try to connect to existing user if email matches
            if (!empty($userData['email'])) {
                $userClass = config('socialite.user_model', \App\Models\User::class);
                $user = $userClass::where('email', $userData['email'])->first();
                if ($user) {
                    $oauthUser->update(['user_id' => $user->id]);
                }
            }
            
            return $oauthUser;
        });
    }
    
    /**
     * Connect an OAuth user to an existing user account.
     *
     * @param OauthConnectedUser $oauthUser
     * @param \Illuminate\Database\Eloquent\Model $user
     * @return OauthConnectedUser
     */
    public function connectToUser(OauthConnectedUser $oauthUser, $user): OauthConnectedUser
    {
        $oauthUser->update(['user_id' => $user->id]);
        return $oauthUser;
    }
    
    /**
     * Get user by OAuth provider and ID.
     *
     * @param string $provider
     * @param string $providerId
     * @return OauthConnectedUser|null
     */
    public function getOauthUser(string $provider, string $providerId): ?OauthConnectedUser
    {
        return OauthConnectedUser::provider($provider)->providerId($providerId)->first();
    }
    
    /**
     * Check if user has OAuth connection for a specific provider.
     *
     * @param \Illuminate\Database\Eloquent\Model $user
     * @param string $provider
     * @return bool
     */
    public function userHasOauthConnection($user, string $provider): bool
    {
        return $user->oauthConnections()->provider($provider)->exists();
    }
    
    /**
     * Get all OAuth connections for a user.
     *
     * @param \Illuminate\Database\Eloquent\Model $user
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUserOauthConnections($user)
    {
        return $user->oauthConnections;
    }
}