<?php

namespace Webup\LaravelTools\Breadcrumb\Facades;

use Illuminate\Support\Facades\Facade;

class Breadcrumb extends Facade
{
    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'breadcrumb';
    }
}
