<?php

namespace Merix\LaraPanel\Backend\Laravel;

use Illuminate\Support\ServiceProvider;
use Merix\LaraPanel\Backend\Laravel\Modules\Config;
use Merix\LaraPanel\Controllers\AdminController;
use Merix\LaraPanel\Core\Components\Menu;
use Merix\LaraPanel\Services\AdminService;

class LaraPanelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        require __DIR__ . '/Http/routes.php';

        \App::singleton('Merix\LaraPanel\Core\Contracts\LaraPanel', function($app){
            return new LaraPanel();
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {



    }
}