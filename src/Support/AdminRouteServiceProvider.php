<?php

namespace Kaneki\LaravelAddons\Support;

use Illuminate\Support\Arr;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

abstract class AdminRouteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot()
    {
        $this->app->call([$this, 'map']);
    }

    /**
     * Define the routes for the addon.
     *
     * @param  \Illuminate\Routing\Router  $router  (injection)
     * @return void
     */
    public function map(Router $router)
    {
        $addon = $this->addon();

        // 加载前台路由
		if ($web = $addon->config('addon.routes')) {
			$this->mapRoutes($web, $addon, $router);
		}
		
        // 加载后台路由
		if ($admin = $addon->config('addon.admin_routes')) {
			$this->mapRoutes($admin, $addon, $router);
		}
    }

    /**
     * 加载路由文件
     *
     * @param $config
     */
    protected function mapRoutes($config, $addon, $router)
    {
        $attributes = [
            'domain' => Arr::get($config, 'domain', null),
            'prefix' => Arr::get($config, 'prefix', ''),
            'namespace' => Arr::get($config, 'namespace', $addon->phpNamespace().'\\Controllers'),
            'middleware' => Arr::get($config, 'middleware', []),
        ];

        $files = array_map(function ($file) use ($addon) {
            return $addon->path($file);
        }, Arr::get($config, 'files', []));
		
        $router->group($attributes, function ($router) use ($files) {
            foreach ($files as $file) {
				if ( file_exists($file) ) {
					require $file;
				}
            }
        });
    }


    /**
     * Get addon.
     *
     * @return \Jumilla\Addomnipot\Laravel\Addon
     */
    abstract protected function addon();

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Pass dynamic methods onto the router instance.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return call_user_func_array([$this->app->make(Router::class), $method], $parameters);
    }
}
