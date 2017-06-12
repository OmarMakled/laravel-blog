<?php

namespace App\Listeners;

use App\Events\Event;
use App\Services\Cacheable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserEventSubscriber
{
    protected $cacheable;

    public function __construct(Cacheable $cacheable)
    {
        $this->cacheable = $cacheable;
    }

    /**
     * Handle user login events.
     */
    public function onUserLogin($event)
    {
        $this->flushCache();

        $this->putCache('entity', $event->user);
        $this->putCache('isAdmin', $event->user->isAdmin());
    }

    protected function putCache($key, $value)
    {
        $this->cacheable->getCacheRepository()->tags('user')->put(
                $this->cacheable->makeCacheKey($key),
                $value,
                $this->cacheable->getCacheMinutes()
            );
    }

    protected function flushCache()
    {
        $this->cacheable->getCacheRepository()->tags('user')->flush();
    }

    /**
     * Handle user login events.
     */
    public function onUserLogout($event)
    {
        $this->flushCache();
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\UserEventSubscriber@onUserLogin'
        );

        $events->listen(
            'Illuminate\Auth\Events\Logout',
            'App\Listeners\UserEventSubscriber@onUserLogout'
        );
    }
}
