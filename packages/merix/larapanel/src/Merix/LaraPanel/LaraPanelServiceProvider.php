<?php

namespace Merix\LaraPanel;

use Illuminate\Support\ServiceProvider;
use Merix\LaraPanel\Controllers\AdminController;

class LaraPanelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        require __DIR__ . '/routes.php';

        $this->loadViewsFrom(__DIR__ .'/Views', 'larapanel');


        $this->publishes([

            __DIR__ . '/../../../published/config/larapanel.php' => config_path('larapanel.php'),
        ], 'config');


        $this->publishes([
            __DIR__ . '/../../../published/assets' => public_path('vendor/larapanel'),
        ], 'assets');


    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../../published/config/larapanel.php', 'larapanel'
        );

    }
}