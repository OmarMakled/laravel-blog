<?php

/*
 * This file is part of Minimum Blog Project for AqarMap 2017.
 *
 * @author Omar Makled <omar.makled@gmail.com>
 */

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace, 'as' => 'blog::'], function (Router $router) {
            $path = app_path('Http/Routes');

            foreach (glob("{$path}/*{,/*}.php", GLOB_BRACE) as $file) {
                $class = substr($file, strlen($path));
                $class = str_replace('/', '\\', $class);
                $class = substr($class, 0, -4);

                $routes = $this->app->make("App\\Http\\Routes${class}");

                $router->group(['middleware' => 'web'], function (Router $router) use ($routes) {
                    $routes->map($router);
                });
            }
        });
    }
}
