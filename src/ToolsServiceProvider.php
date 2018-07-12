<?php

namespace Webup\LaravelTools;

use Illuminate\Support\ServiceProvider;
use Webup\LaravelTools\Breadcrumb;
use Webup\LaravelTools\Flash;

class ToolsServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('breadcrumb', function ($app) {
            return new Breadcrumb();
        });

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
        $this->loadViewsFrom(__DIR__.'/views', 'tools');

        $this->publishes([
            __DIR__.'/views' => resource_path('views/vendor/tools'),
        ], 'tools');
    }
}
