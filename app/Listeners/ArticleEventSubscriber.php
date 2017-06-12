<?php

namespace App\Listeners;

use App\Events\Event;
use App\Services\Cacheable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ArticleEventSubscriber
{
    protected $cacheable;

    public function __construct(Cacheable $cacheable)
    {
        $this->cacheable = $cacheable;
    }

    /**
     * Handle user login events.
     */
    public function onArticleSaved($event)
    {
        $this->cacheable->getCacheRepository()
            ->tags('articles')
            ->flush();
    }

    /**
     * Handle user logout events.
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
