<?php

/*
 * This file is part of Minimum Blog Project for AqarMap 2017.
 *
 * @author Omar Makled <omar.makled@gmail.com>
 */

namespace App\Services;

use App\Services\Cacheable;
use Illuminate\Contracts\Auth\Guard;

class CurrentUser
{
    /**
     * The user session object.
     *
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $guard;

    /**
     * Cacheable instance
     *
     * @var \App\Services\Cacheable
     */
    protected $cacheable;

    /**
     * Default visitor.
     *
     * @var int
     */
    const VISITOR = 1;

    /**
     * Create a new current user instance.
     *
     * @param \Illuminate\Contracts\Auth\Guard          $guard
     * @param \App\Services\Cacheable                   $cacheable
     *
     * @return void
     */
    public function __construct(Guard $guard, Cacheable $cacheable)
    {
        $this->guard = $guard;
        $this->cacheable = $cacheable;
    }

    /**
     * Determine if a current user is an admin.
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return (bool) $this->getCache('isAdmin');
    }

    /**
     * Determine if a current user is a guest.
     *
     * @return boolean
     */
    public function isGuest()
    {
        return (bool) ! $this->getCache('entity');
    }

    /**
     * Get current user id
     *
     * @return int
     */
    public function id()
    {
        return ($entity = $this->getCache('entity'))
            ? $entity->id
            : self::VISITOR;
    }

    /**
     * Get from cache
     *
     * @param mixed $key
     *
     * @return mixed|null
     */
    protected function getCache($key)
    {
        return $this->cacheable->getCacheRepository()
            ->tags('user')->get($this->cacheable->makeCacheKey($key));
    }
}
