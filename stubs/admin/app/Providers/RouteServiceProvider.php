<?php

namespace {$namespace}\Providers;

use Illuminate\Routing\Router;
use Hinet\LaravelAddons\Support\AdminRouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define the routes for the addon.
     *
     * @param  \Illuminate\Routing\Router  $router  (injection)
     * @return void
     */
    public function map(Router $router)
    {
        parent::map($router);
    }

    /**
     * Get addon.
     *
     * @return \Hinet\LaravelAddons\Addon
     */
    protected function addon()
    {
        return addon();
    }
}
