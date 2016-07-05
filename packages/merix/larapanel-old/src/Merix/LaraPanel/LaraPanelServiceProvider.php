<?php

namespace Merix\LaraPanel;

use Illuminate\Support\ServiceProvider;
use Merix\LaraPanel\Controllers\AdminController;
use Merix\LaraPanel\Services\AdminService;
use Yajra\Datatables\DatatablesServiceProvider;

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
        $this->registerRequiredProviders();


        $this->mergeConfigFrom(
            __DIR__ . '/../../../published/config/larapanel.php', 'larapanel'
        );

    }

    /**
     * Register 3rd party providers.
     */
    protected function registerRequiredProviders()
    {
        $this->app->register(DatatablesServiceProvider::class);
    }
}