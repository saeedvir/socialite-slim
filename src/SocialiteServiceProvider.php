<?php

namespace Saeedvir\SocialiteSlim;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Saeedvir\SocialiteSlim\Contracts\Factory;
use Saeedvir\SocialiteSlim\Services\OauthConnectionService;

class SocialiteServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Factory::class, function ($app) {
            return new SocialiteManager($app);
        });

        $this->app->singleton('socialite.oauth', function ($app) {
            return new OauthConnectionService();
        });

        $this->mergeConfigFrom(
            __DIR__.'/../config/socialite.php', 'socialite'
        );
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/socialite.php' => config_path('socialite.php'),
            ], 'socialite-config');

            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations'),
            ], 'socialite-migrations');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Factory::class, 'socialite.oauth'];
    }
}