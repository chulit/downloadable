<?php

namespace Diskominfotik\Downloadable;

use Illuminate\Support\ServiceProvider;

class DownloadableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Register the main class to use with the facade
        $this->app->singleton('downloadable', function () {
            return new Downloadable;
        });
    }
}
