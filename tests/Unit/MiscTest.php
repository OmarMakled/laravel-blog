<?php

/*
 * This file is part of Minimum Blog Project for AqarMap 2017.
 *
 * @author Omar Makled <omar.makled@gmail.com>
 */

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Services\Cacheable;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MiscTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testMakeCacheKey()
    {
        $cache = app(Cacheable::class);

        $this->assertEquals($cache->makeCacheKey('article', 1), 'article@d4745e82aecb406b29b31e88c9ff0e4a');
        $this->assertEquals($cache->makeCacheKey('category', 1, 1), 'category@eda547cc8500abcefd65dba937b24d83');
    }

   /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserIsAdmin()
    {
        $user = User::find(1);
        $this->assertEquals(0, $user->isAdmin());

        $user = User::find(2);
        $this->assertEquals(1, $user->isAdmin());
    }

   /**
     * A basic test example.
     *
     * @return void
     */
    public function testCacheUser()
    {
        $cache = app(Cacheable::class);

        $user = User::find(1);
        $cache->getCacheRepository()->tags('user')->put(
            $cache->makeCacheKey('entity'),
            $user,
            $cache->getCacheMinutes()
        );
        $this->assertEquals(1, $cache->getCacheRepository()->tags('user')->get($cache->makeCacheKey('entity'))->id);
    }
}
