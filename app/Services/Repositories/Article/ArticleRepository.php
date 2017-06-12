<?php

/*
 * This file is part of Minimum Blog Project for AqarMap 2017.
 *
 * @author Omar Makled <omar.makled@gmail.com>
 */

namespace App\Services\Repositories\Article;

use App\Models\Article;
use App\Models\Category;
use App\Services\Repositories\Article\ArticleInterface;

class ArticleRepository implements ArticleInterface
{
    /**
     * The article model instance
     *
     * @var \App\Models\Article
     */
    protected $article;

    /**
     * The category model instance
     *
     * @var \App\Models\Category
     */
    protected $category;

    /**
     * Create a new article repository.
     *
     * @param \App\Models\Article  $article
     * @param \App\Models\Category $category
     *
     * @return void
     */
    public function __construct(Article $article, Category $category)
    {
        $this->article = $article;
        $this->category = $category;
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
        return $this->article
            ->with(['user', 'categories'])
            ->latest()
            ->paginate($limit);
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
        return $this->article->with(['user', 'categories'])
                ->whereHas('categories', function ($query) use ($category) {
                    $query->where('article_category.category_id', $category);
                }
            )->paginate($limit);
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
        return $this->article
            ->with([
                'user',
                'categories',
                'comments'  =>  function ($query) {
                    $query->latest();
                },
                'comments.user'
            ])->find($id);
    }

    /**
     * Add new article
     *
     * @param string $title
     * @param string $content
     * @param int $user_id
     * @param array $categories
     *
     * @param \App\Models\Article
     */
    public function add($title, $content, $user_id, $categories)
    {
        $article = $this->article->create([
            'title'     =>  $title,
            'content'   =>  $content,
            'user_id'   =>  $user_id
        ]);

        $article->categories()->sync($categories);

        return $article;
    }

    /**
     * Update an existing article
     *
     * @param int $id
     * @param string $title
     * @param string $content
     * @param array $categories
     *
     * @param \App\Models\Article
     */
    public function update($id, $title, $content, $categories)
    {
        $article = $this->article->find($id);
        $article->fill([
            'title'     =>  $title,
            'content'   =>  $content,
        ])->save();

        $article->categories()->sync($categories);

        return $article;
    }

    /**
     * Add a new article comment
     *
     * @param int $id
     * @param string $content
     * @param int $user_id
     *
     * @param \App\Models\Article
     */
    public function addComment($id, $content, $user_id)
    {
        $article = $this->article->find($id);
        $article->comments()->create([
            'content'   =>  $content,
            'user_id'   =>  $user_id
        ]);

        return $article;
    }

    /**
     * Retrieve cateories list
     *
     * @param array $columns
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function listCategories($columns = ['id', 'name'])
    {
        return $this->category->select($columns)->get();
    }

    /**
     * Retrieve cateories with articles
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function listCategoriesWithArticles()
    {
        return $this->category->with('articles')->get();
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
        return $this->article
            ->with('user')
            ->orderBy('id', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Retrieve default category ids
     *
     * @param array $ids
     *
     * @return array
     */
    public function defaultCategoryIds($ids = [1])
    {
        return $this->category->whereIn('id', $ids)
            ->pluck('id')
            ->toArray();
    }

    /**
     * Get article model
     *
     * @return \App\Models\Article
     */
    public function getModel()
    {
        return $this->article;
    }
}
