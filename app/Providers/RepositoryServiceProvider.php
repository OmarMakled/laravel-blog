<?php

/*
 * This file is part of Minimum Blog Project for AqarMap 2017.
 *
 * The main benefit of decorating pattern are
 *     - we can switch db provider easily mysql, elstic , etc ..
 *     - implementing different behavior such as cache, log , etc ..
 *
 * @author Omar Makled <omar.makled@gmail.com>
 */

namespace App\Providers;

use App\Services\Cacheable;
use Illuminate\Support\ServiceProvider;
use App\Services\Repositories\Article\ArticleCacheable;
use App\Services\Repositories\Article\ArticleInterface;
use App\Services\Repositories\Article\ArticleRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ArticleInterface::class, function ($app) {
             // return $app->make(ArticleRepository::class);

             return new ArticleCacheable(
                $app->make(ArticleRepository::class), $app->make(Cacheable::class)
            );
         });
    }
}
