<?php

namespace Saeedvir\SocialiteSlim;

use Illuminate\Support\Facades\Facade;
use Saeedvir\SocialiteSlim\Contracts\Factory;
use Saeedvir\SocialiteSlim\Testing\SocialiteFake;

/**
 * @method static \Saeedvir\SocialiteSlim\Contracts\Provider driver(string $driver = null)
 * @method static \Saeedvir\SocialiteSlim\Two\AbstractProvider buildProvider(string $provider, array $config)
 * @method static \Saeedvir\SocialiteSlim\SocialiteManager extend(string $driver, \Closure $callback)
 * @method static array getScopes()
 * @method static \Saeedvir\SocialiteSlim\Contracts\Provider scopes(array|string $scopes)
 * @method static \Saeedvir\SocialiteSlim\Contracts\Provider setScopes(array|string $scopes)
 * @method static \Saeedvir\SocialiteSlim\Contracts\Provider redirectUrl(string $url)
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

    /**
     * Register a fake Socialite instance.
     *
     * @param  string  $driver
     * @param  \Saeedvir\SocialiteSlim\Contracts\User|\Closure|null  $user
     * @return \Saeedvir\SocialiteSlim\Testing\SocialiteFake
     */
    public static function fake(string $driver, $user = null)
    {
        $root = static::getFacadeRoot();

        if ($root instanceof SocialiteFake) {
            $fake = $root;
        } else {
            $fake = new SocialiteFake($root);

            static::swap($fake);
        }

        return $fake->fake($driver, $user);
    }
}