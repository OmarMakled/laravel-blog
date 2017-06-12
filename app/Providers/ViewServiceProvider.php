<?php

/*
 * This file is part of Minimum Blog Project for AqarMap 2017.
 *
 * @author Omar Makled <omar.makled@gmail.com>
 */

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\ServiceProvider;
use App\Services\Composers\SidebarComposer;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @param \Illuminate\Contracts\View\Factory $factory
     *
     * @return void
     */
    public function boot(Factory $factory)
    {
        $factory->composer('_partails/sidebar',  SidebarComposer::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->adminDirective();
        $this->guestDirective();
    }

    /**
     * Create admin directive
     *
     * @return void
     */
    protected function adminDirective()
    {
        Blade::directive('admin', function ($expression) {
            return "<?php if (currentUser()->isAdmin()): ?>";
        });

        Blade::directive('endadmin', function ($expression) {
            return '<?php endif; ?>';
        });
    }

    /**
     * Create guest directive
     *
     * @return void
     */
    protected function guestDirective()
    {
        Blade::directive('guest', function ($expression) {
            return "<?php if (currentUser()->isGuest()): ?>";
        });

        Blade::directive('endguest', function ($expression) {
            return '<?php endif; ?>';
        });
    }
}
