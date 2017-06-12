<?php

/*
 * This file is part of Minimum Blog Project for AqarMap 2017.
 *
 * @author Omar Makled <omar.makled@gmail.com>
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\Presenters\ArticlePresenter;
use App\Services\Presenters\Foundation\PresentableTrait;

class Article extends Model
{
    use PresentableTrait;

    /**
     * view presenter instance
     *
     * @var mixed
     */
    protected $presenter = ArticlePresenter::class;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::saved(function ($article) {

            event('article.saved', $article);
        });
    }

    /**
     * Define the user relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define the comments relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Define the categories relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Get the category ids.
     *
     * @return array
     */
    public function getCategoryIdsAttribute()
    {
        return $this->categories->pluck('id')->toArray();
    }
}
