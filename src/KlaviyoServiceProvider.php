<?php

namespace Baorv\Klaviyo;

use Illuminate\Support\ServiceProvider;
use Ixudra\Curl\CurlServiceProvider;
use Baorv\Klaviyo\Clients\PublicApi;
use Baorv\Klaviyo\Clients\SecretApi;
use Baorv\Klaviyo\Contracts\SecretApiContract;
use Baorv\Klaviyo\Contracts\PublicApiContract;

/**
 * Class KlaviyoServiceProvider
 *
 * @package Baorv\Klaviyo
 * @author baorv <roanvanbao@gmail.com>
 * @version 0.0.1
 */
class KlaviyoServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap of this service provider
     */
    public function boot()
    {

        /**
         * Publish configurations of this package
         */
        $this->publishes([
            __DIR__ . '/../config/klaviyo.php' => config_path('klaviyo.php'),
        ]);
    }

    /**
     * Register something of this service provider
     */
    public function register()
    {

        /**
         * Register dependencies service providers
         */
        $this->app->register(CurlServiceProvider::class);

        /**
         * Register this service provider
         */
        $this->app->singleton(SecretApiContract::class, function() {
            return new SecretApi(config('klaviyo.apiKey'));
        });
        $this->app->singleton(PublicApiContract::class, function() {
            return new PublicApi(config('klaviyo.publicKey'));
        });
    }
}