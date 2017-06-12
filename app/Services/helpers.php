<?php

/*
 * This file is part of Minimum Blog Project for AqarMap 2017.
 *
 * @author Omar Makled <omar.makled@gmail.com>
 */

if (!function_exists('currentUser')) {
    /**
     * Get a new current user instance.
     *
     * @return \App\Services\CurrentUser
     */
    function currentUser()
    {
        return app('App\Services\CurrentUser');
    }
}
