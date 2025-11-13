<?php

namespace Saeedvir\SocialiteSlim\Contracts;

interface Factory
{
    /**
     * Get an OAuth provider implementation.
     *
     * @param  string  $driver
     * @return \Saeedvir\SocialiteSlim\Contracts\Provider
     */
    public function driver($driver = null);
}