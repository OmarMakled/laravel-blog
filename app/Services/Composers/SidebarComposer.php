<?php

/*
 * This file is part of Minimum Blog Project for AqarMap 2017.
 *
 * @author Omar Makled <omar.makled@gmail.com>
 */

namespace App\Services\Composers;

use Illuminate\Contracts\View\View;
use App\Services\Repositories\Article\ArticleInterface;

class SidebarComposer
{
    /**
     * Repository layer
     *
     * @var \App\Services\Repositories\Article\ArticleInterface
     */
    protected $repo;

    /**
     * Create a new sidebar composer instance.
     *
     * @param \App\Services\Repositories\Article\ArticleInterface $repo
     */
    public function __construct(ArticleInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Bind data to the view.
     *
     * @param \Illuminate\Contracts\View\View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $view->withSideBarCategories($this->repo->listCategoriesWithArticles());
        $view->withSideBarLatestArticles($this->repo->latestArticles());
    }
}
