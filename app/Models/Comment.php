<?php

/*
 * This file is part of Minimum Blog Project for AqarMap 2017.
 *
 * @author Omar Makled <omar.makled@gmail.com>
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\Presenters\CommentPresenter;
use App\Services\Presenters\Foundation\PresentableTrait;

class Comment extends Model
{
    use PresentableTrait;

    /**
     * view presenter instance
     *
     * @var mixed
     */
    protected $presenter = CommentPresenter::class;

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

        static::saved(function ($comment) {
            event('comment.added', $comment);
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
}
