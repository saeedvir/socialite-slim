<?php

namespace Saeedvir\SocialiteSlim\Traits;

trait HasOAuthConnections
{
    /**
     * Get the OAuth connections for the user.
     */
    public function oauthConnections()
    {
        return $this->hasMany(\Saeedvir\SocialiteSlim\Models\OauthConnectedUser::class);
    }

    /**
     * Check if user has OAuth connection for a specific provider.
     *
     * @param string $provider
     * @return bool
     */
    public function hasOauthConnection($provider)
    {
        return $this->oauthConnections()->provider($provider)->exists();
    }

    /**
     * Get OAuth connection for a specific provider.
     *
     * @param string $provider
     * @return \Saeedvir\SocialiteSlim\Models\OauthConnectedUser|null
     */
    public function getOauthConnection($provider)
    {
        return $this->oauthConnections()->provider($provider)->first();
    }

    /**
     * Connect an OAuth account to this user.
     *
     * @param \Saeedvir\SocialiteSlim\Models\OauthConnectedUser $oauthUser
     * @return \Saeedvir\SocialiteSlim\Models\OauthConnectedUser
     */
    public function connectOauthAccount($oauthUser)
    {
        $oauthUser->update(['user_id' => $this->id]);
        return $oauthUser;
    }
}