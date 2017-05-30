<?php

namespace Webup\LaravelTools\Flash;

use Illuminate\Support\ServiceProvider;
use Webup\LaravelTools\Flash\Flash;

class FlashServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('flash', function ($app) {
            return new Flash($app->make(\Illuminate\Session\Store::class));
        });
    }


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../views', 'tools');

        $this->publishes([
            __DIR__.'/../views' => resource_path('views/vendor/tools'),
        ], 'tools');
    }
}
