<?php

/*
 * This file is part of Minimum Blog Project for AqarMap 2017.
 *
 * @author Omar Makled <omar.makled@gmail.com>
 */

namespace App\Services\Repositories\Article;

use App\Services\Cacheable;
use App\Services\Repositories\Article\ArticleInterface;
use App\Services\Repositories\Foundation\CacheableTrait;
use App\Services\Repositories\Article\ArticleRepository;

class ArticleCacheable implements ArticleInterface
{
    use CacheableTrait;

    /**
     * ArticleRepository instance
     *
     * @var \App\Services\Repositories\Article\ArticleRepository
     */
    protected $repo;

    /**
     * Cacheable instance
     *
     * @var \App\Services\Cacheable
     */
    protected $cacheable;

    /**
     * Create a new article cacheable instance
     *
     * @param \App\Services\Repositories\Article\ArticleRepository $repo
     * @param \App\Services\Cacheable         $cacheable
     *
     * @return void
     */
    public function __construct(ArticleRepository $repo, Cacheable $cacheable)
    {
        $this->repo = $repo;

        $this->cacheable = $cacheable;
    }

    /**
     * Retrieve all articles, paginated
     *
     * @param int $limit
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($limit = 10)
    {
        return $this->cache->tags('articles')->remember(
            $this->key('page', request('page')), $this->minutes, function () {
                return $this->repo->paginate($limit = 10);
            });
    }

     /**
     * Find article with comments by id
     *
     * @param int $id
     *
     * @return \App\Models\Article
     */
    public function find($id)
    {
        return $this->cache->tags('articles')->remember(
            $this->key('article', $id), $this->minutes, function () use ($id) {
                return $this->repo->find($id);
            });
    }

    /**
     * Retrieve all articles by category, paginated
     *
     * @param int $category
     * @param int $limit
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function byCategory($category, $limit = 10)
    {
        return $this->cache->tags('articles')->remember(
            $this->key('category', $category, request('page')), $this->minutes, function () use ($category, $limit) {
                return $this->repo->byCategory($category, $limit);
            });
    }

    /**
     * Retrieve cateories with articles
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function listCategoriesWithArticles()
    {
        return $this->cache->tags('articles')->remember(
            $this->key('category', 'tags'), $this->minutes, function () {
                return $this->repo->listCategoriesWithArticles();
            });
    }

    /**
     * Retrieve latest added articles
     *
     * @param int $limit
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function latestArticles($limit = 10)
    {
        return $this->cache->tags('articles')->remember(
            $this->key('latest'), $this->minutes, function () use ($limit) {
                return $this->repo->latestArticles($limit);
            });
    }

   /**
     * Retrieve cateories list
     *
     * @param array $columns
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function listCategories($fields = ['id', 'name'])
    {
        return $this->cache->tags('articles')->remember(
            $this->key('category', 'list'), $this->minutes, function () use ($fields) {
                return $this->repo->listCategories($fields);
            });
    }
}
