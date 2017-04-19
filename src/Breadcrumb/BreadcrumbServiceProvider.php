<?php

namespace Webup\LaravelTools\Breadcrumb;

use Illuminate\Support\ServiceProvider;
use Webup\LaravelTools\Breadcrumb\Breadcrum;

class BreadcrumbServiceProvider extends ServiceProvider
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
