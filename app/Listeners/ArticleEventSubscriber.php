<?php

/*
 * This file is part of Minimum Blog Project for AqarMap 2017.
 *
 * @author Omar Makled <omar.makled@gmail.com>
 */

namespace App\Listeners;

use App\Events\Event;
use App\Services\Cacheable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ArticleEventSubscriber
{
    /**
     * Cacheable instance
     *
     * @var \App\Services\Cacheable
     */
    protected $cacheable;

    /**
     * Create a new articles event subscriber instance.
     *
     * @param \App\Services\Cacheable $cacheable
     *
     * @return void
     */
    public function __construct(Cacheable $cacheable)
    {
        $this->cacheable = $cacheable;
    }

    /**
     * Handle article saved.
     *
     * @param \App\Models\Article $event
     *
     * @return void
     */
    public function onArticleSaved($event)
    {
        $this->cacheable->getCacheRepository()
            ->tags('articles')
            ->flush();
    }

    /**
     * Handle comment added.
     *
     * @param \App\Models\Article $event
     *
     * @return void
     */
    public function onCommentAdded($event)
    {
        $this->cacheable->getCacheRepository()
            ->tags('articles')
            ->forget($this->cacheable->makeCacheKey('article', (string)$event->article_id));
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'article.saved',
            'App\Listeners\ArticleEventSubscriber@onArticleSaved'
        );

        $events->listen(
            'comment.added',
            'App\Listeners\ArticleEventSubscriber@onCommentAdded'
        );
    }
}
