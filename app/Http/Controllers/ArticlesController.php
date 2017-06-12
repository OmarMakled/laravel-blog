<?php

/*
 * This file is part of Minimum Blog Project for AqarMap 2017.
 *
 * @author Omar Makled <omar.makled@gmail.com>
 */

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Http\Requests\CommentRequest;
use App\Services\Repositories\Article\ArticleInterface;

class ArticlesController extends Controller
{
    /**
     * Repository layer
     *
     * @var \App\Services\Repositories\Article\ArticleInterface
     */
    protected $articleRepo;

    /**
     * Create a new articles controller instance.
     *
     * @param \App\Services\Repositories\Article\ArticleInterface $articleRepo
     *
     * @return void
     */
    public function __construct(ArticleInterface $articleRepo)
    {
        $this->articleRepo = $articleRepo;
    }

    /**
     * Show all articles
     *
     * @return \Illuminate\View\View
     */
    public function showArticles()
    {
        return view('articles/index')
            ->withArticles($this->articleRepo->paginate());
    }

    /**
     * Show article by id
     *
     * @param int $article
     *
     * @return \Illuminate\View\View
     */
    public function showArticle($article)
    {
        return view('articles/show')
            ->withArticle($this->articleRepo->find($article));
    }

    /**
     * Show create article form
     *
     * @return \Illuminate\View\View
     */
    public function showCreateArticle()
    {
        return view('articles/create')
            ->withArticle($this->articleRepo->getModel())
            ->withCategories($this->articleRepo->listCategories());
    }

    /**
     * Show edit article form
     *
     * @param  int $article
     *
     * @return \Illuminate\View\View
     */
    public function showEditArticle($article)
    {
        return view('articles/edit')
            ->withArticle($this->articleRepo->find($article))
            ->withCategories($this->articleRepo->listCategories());
    }

    /**
     * Store new article
     *
     * @param  \App\Http\Requests\ArticleRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeArticle(ArticleRequest $request)
    {
        $this->articleRepo->add(
            $request->title,
            $request->content,
            $request->user_id,
            $request->categories
        );

        $request->session()->flash('success', trans('text.flash.success'));

        return redirect('/');
    }

    /**
     * Update an existing article
     *
     * @param  int         $article
     * @param  \App\Http\Requests\ArticleRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateArticle($article, ArticleRequest $request)
    {
        $this->articleRepo->update(
            $article,
            $request->title,
            $request->content,
            $request->categories
        );

        $request->session()->flash('success', trans('text.flash.success'));

        return redirect('articles/'.$article);
    }

    /**
     * Store new comment
     *
     * @param  int         $article
     * @param  \App\Http\Requests\CommentRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeComment($article, CommentRequest $request)
    {
        $this->articleRepo->addComment(
            $article,
            $request->content,
            $request->user_id
        );

        $request->session()->flash('success', trans('text.flash.success'));

        return redirect('articles/'.$article);
    }
}
