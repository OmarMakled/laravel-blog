<?php

/*
 * This file is part of Minimum Blog Project for AqarMap 2017.
 *
 * @author Omar Makled <omar.makled@gmail.com>
 */

namespace App\Services;

use Illuminate\Cache\Repository;

class Cacheable
{
    /**
     * The cache minutes.
     *
     * @var string
     */
    const Cache_Minutes = 60;

    /**
     * The cache repository
     *
     * @var \Illuminate\Cache\Repository
     */
    protected $cacheRepository;

    /**
     * Create a new cacheable instance.
     *
     * @param \Illuminate\Cache\Repository $cacheRepository
     */
    public function __construct(Repository $cacheRepository)
    {
        $this->cacheRepository = $cacheRepository;
    }

    /**
     * Get cache repository
     *
     * @return \Illuminate\Cache\Repository
     */
    public function getCacheRepository()
    {
        return $this->cacheRepository;
    }

    /**
     * Get cache minutes
     *
     * @return int
     */
    public function getCacheMinutes()
    {
        return self::Cache_Minutes;
    }

    /**
     * Make unique cache key
     *
     * @param  string $model
     * @param  mixed|null $args
     *
     * @return string
     */
    public function makeCacheKey($model, ... $args)
    {
        return sprintf('%s@%s', $model, md5(serialize($args)));
    }
}
