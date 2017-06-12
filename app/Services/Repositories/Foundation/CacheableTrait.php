<?php

/*
 * This file is part of Minimum Blog Project for AqarMap 2017.
 *
 * @author Omar Makled <omar.makled@gmail.com>
 */

namespace App\Services\Repositories\Foundation;

trait CacheableTrait
{
    /**
     * Handle non cacheable methods
     *
     * @param  string   $name
     * @param  mixed    $arguments
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        if (! method_exists($this, $name)) {
            return $this->repo->$name(... $arguments);
        }
    }

    /**
     * Allow for property-style retrieval
     *
     * @param $property
     * @return mixed
     */
    public function __get($property)
    {
        if (method_exists($this, $property)) {
            return $this->{$property}();
        }

        return $this->{$property};
    }

    /**
     * Get cache repository
     *
     * @return \Illuminate\Cache\Repository
     */
    public function cache()
    {
        return $this->cacheable->getCacheRepository();
    }

    /**
     * Make unique cache key
     *
     * @param  string $model
     * @param  mixed|null $args
     *
     * @return string
     */
    public function key($key, ... $args)
    {
        return $this->cacheable->makeCacheKey($key, ... $args);
    }

    /**
     * Get cache minutes
     *
     * @return int
     */
    public function minutes()
    {
        return $this->cacheable->getCacheMinutes();
    }
}
