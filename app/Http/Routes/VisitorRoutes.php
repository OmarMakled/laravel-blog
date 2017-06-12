<?php

/*
 * This file is part of Minimum Blog Project for AqarMap 2017.
 *
 * @author Omar Makled <omar.makled@gmail.com>
 */

namespace App\Http\Routes;

use App\Http\Routes\BaseRouter;
use Illuminate\Contracts\Routing\Registrar;

class VisitorRoutes extends BaseRouter
{
    /**
     * Define the user session routes.
     *
     * @param \Illuminate\Contracts\Routing\Registrar $router
     *
     * @return void
     */
    protected function session(Registrar $router)
    {
        $router->group([], function (Registrar $router) {
            $router->get('login', [
                'middleware'    =>  'guest',
                'uses'          =>  'LoginController@showLoginForm'
            ]);
            $router->post('login', [
                'middleware'    =>  'guest',
                'uses'          =>  'LoginController@postLogin'
            ]);
            $router->get('logout', [
                'middleware'    =>  'auth',
                'uses'          =>  'LoginController@getLogout'
            ]);
        });
    }

    /**
     * Define the visitor articles routes.
     *
     * @param \Illuminate\Contracts\Routing\Registrar $router
     *
     * @return void
     */
    protected function articles(Registrar $router)
    {
        $router->group([
            'middleware' => []
        ], function (Registrar $router) {
            $router->get('', [
                'uses'  =>  'ArticlesController@showArticles'
            ]);
            $router->get('articles', [
                'uses'  =>  'ArticlesController@showArticles'
            ]);
            $router->get('articles/{article}', [
                'uses'  =>  'ArticlesController@showArticle'
            ]);
            $router->post('articles/{article}/comment', [
                'uses'  =>  'ArticlesController@storeComment'
            ]);
            $router->get('categories/{category}', [
                'uses'  =>  'CategoriesController@showCategories'
            ]);
        });
    }
}
