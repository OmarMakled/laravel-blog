<?php

/*
 * This file is part of Minimum Blog Project for AqarMap 2017.
 *
 * @author Omar Makled <omar.makled@gmail.com>
 */

namespace App\Http\Routes;

use App\Http\Routes\BaseRouter;
use Illuminate\Contracts\Routing\Registrar;

class AdminRoutes extends BaseRouter
{
    /**
     * Define the admin articles routes.
     *
     * @param \Illuminate\Contracts\Routing\Registrar $router
     *
     * @return void
     */
    protected function articles(Registrar $router)
    {
        $router->group([
            'middleware' => ['auth', 'admin']
        ], function (Registrar $router) {
            $router->post('articles', [
                'uses' => 'ArticlesController@storeArticle',
            ]);
            $router->get('articles/create', [
                'uses'  =>  'ArticlesController@showCreateArticle'
            ]);
            $router->put('articles/{article}', [
                'uses'  => 'ArticlesController@updateArticle'
            ]);
            $router->get('articles/{article}/edit', [
                'uses'  =>  'ArticlesController@showEditArticle'
            ]);
        });
    }
}
