<?php

namespace Saeedvir\SocialiteSlim;

use Illuminate\Support\Facades\Facade;
use Saeedvir\SocialiteSlim\Contracts\Factory;

/**
 * @method static \Saeedvir\SocialiteSlim\Contracts\Provider driver(string $driver = null)
 * @method static \Saeedvir\SocialiteSlim\Two\AbstractProvider buildProvider(string $provider, array $config)
 * @method static \Saeedvir\SocialiteSlim\SocialiteManager extend(string $driver, \Closure $callback)
 * @method array getScopes()
 * @method \Saeedvir\SocialiteSlim\Contracts\Provider scopes(array|string $scopes)
 * @method \Saeedvir\SocialiteSlim\Contracts\Provider setScopes(array|string $scopes)
 * @method \Saeedvir\SocialiteSlim\Contracts\Provider redirectUrl(string $url)
 *
 * @see \Saeedvir\SocialiteSlim\SocialiteManager
 */
class Socialite extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Factory::class;
    }
}