<?php

namespace Saeedvir\SocialiteSlim\Facades;

use Illuminate\Support\Facades\Facade;

class OAuth extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'socialite.oauth';
    }
}