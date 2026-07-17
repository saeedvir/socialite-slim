<?php

namespace Saeedvir\SocialiteSlim\Testing;

use Saeedvir\SocialiteSlim\Contracts\Factory;

class SocialiteFake implements Factory
{
    /**
     * The original factory instance.
     *
     * @var \Saeedvir\SocialiteSlim\Contracts\Factory
     */
    protected $factory;

    /**
     * The fake provider instances.
     *
     * @var array<string, \Saeedvir\SocialiteSlim\Testing\FakeProvider>
     */
    protected $providers = [];

    /**
     * Create a new Socialite fake instance.
     *
     * @param  \Saeedvir\SocialiteSlim\Contracts\Factory  $factory
     */
    public function __construct($factory)
    {
        $this->factory = $factory;
    }

    /**
     * Get an OAuth provider implementation.
     *
     * @param  string  $driver
     * @return \Saeedvir\SocialiteSlim\Contracts\Provider
     */
    public function driver($driver = null)
    {
        return $this->providers[$driver] ?? $this->factory->driver($driver);
    }

    /**
     * Register a fake user for the given driver.
     *
     * @param  string  $driver
     * @param  \Saeedvir\SocialiteSlim\Contracts\User|\Closure|null  $user
     * @return $this
     */
    public function fake($driver, $user = null)
    {
        $resolver = function () use ($driver) {
            return $this->factory->driver($driver);
        };

        $this->providers[$driver] = new FakeProvider($driver, $resolver, $user);

        return $this;
    }
}