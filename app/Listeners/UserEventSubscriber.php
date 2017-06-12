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

class UserEventSubscriber
{
    /**
     * Cacheable instance
     *
     * @var \App\Services\Cacheable
     */
    protected $cacheable;

    /**
     * Create a new user event subscriber instance.
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
     * Handle user login events.
     *
     * @param mixed $event
     *
     * @return void
     */
    public function onUserLogin($event)
    {
        $this->flushCache();

        $this->putCache('entity', $event->user);
        $this->putCache('isAdmin', $event->user->isAdmin());
    }

    /**
     * Handle user logout events.
     *
     * @param mixed $event
     *
     * @return void
     */
    public function onUserLogout($event)
    {
        $this->flushCache();
    }

    /**
     * Put to user tage cache
     *
     * @param string $key
     * @param mixed $value
     *
     * @return void
     */
    protected function putCache($key, $value)
    {
        $this->cacheable->getCacheRepository()->tags('user')->put(
                $this->cacheable->makeCacheKey($key),
                $value,
                $this->cacheable->getCacheMinutes()
            );
    }

    /**
     * Flush all user cache
     *
     * @return void
     */
    protected function flushCache()
    {
        $this->cacheable->getCacheRepository()->tags('user')->flush();
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
