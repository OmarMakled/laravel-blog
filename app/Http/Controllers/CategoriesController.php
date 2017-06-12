<?php

/*
 * This file is part of Minimum Blog Project for AqarMap 2017.
 *
 * @author Omar Makled <omar.makled@gmail.com>
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Repositories\Article\ArticleInterface;

class CategoriesController extends Controller
{
    /**
     * Repository layer
     *
     * @var \App\Services\Repositories\Article\ArticleInterface
     */
    protected $articleRepo;

    /**
     * Create a new categories controller instance.
     *
     * @param \App\Services\Repositories\Article\ArticleInterface $articleRepo
     */
    public function __construct(ArticleInterface $articleRepo)
    {
        $this->articleRepo = $articleRepo;
    }

    /**
     * Show articles by category id
     *
     * @param int $category
     *
     * @return \Illuminate\View\View
     */
    public function showCategories($category)
    {
        return view('articles/index')
            ->withArticles($this->articleRepo->byCategory($category));
    }
}
