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
            return new Breadcrum();
        });
    }


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // View::composer('elements.breadcrumb', BreadcrumbComposer::class);
    }
}
