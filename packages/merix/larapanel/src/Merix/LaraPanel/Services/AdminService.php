<?php

namespace Merix\LaraPanel\Services;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Collection;
use Merix\LaraPanel\Admin;

class AdminService
{

    public function loadAdminConfigs()
    {
        $configService = new ConfigService();

        $global = $configService->getGlobalConfig();

        foreach($global->panels as $panelName)
        {
            $panel = $configService->getPanelConfig($panelName);

            Route::get($panel->route, 'Merix\LaraPanel\Controllers\TestController@index');

        }


    }


    public function getGlobalAdminConfig()
    {



    }

    public function getAdminConfig()
    {


    }

}