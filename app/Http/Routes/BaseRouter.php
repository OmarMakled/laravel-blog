<?php

/*
 * This file is part of Minimum Blog Project for AqarMap 2017.
 *
 * @author Omar Makled <omar.makled@gmail.com>
 */

namespace App\Http\Routes;

use ReflectionMethod;
use Illuminate\Contracts\Routing\Registrar;

class BaseRouter
{
    /**
     * Define the app routes.
     *
     * @param \Illuminate\Contracts\Routing\Registrar $router
     *
     * @return void
     */
    public function map(Registrar $router)
    {
        // let's organize routes in appropriate way
        // whenever app goes bigger it would be painful
        $methods = get_class_methods($this);
        foreach ($methods as $method) {
            $reflect = new ReflectionMethod($this, $method);
            if ($reflect->isProtected()) {
                $this->$method($router);
            }
        }
    }
}
