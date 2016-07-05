<?php

namespace Merix\LaraPanel\Services;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Collection;
use Merix\LaraPanel\Admin;

class ConfigService
{

    public function getGlobalConfig()
    {
        return config('larapanel');

    }

    public function getPanelConfig($panel)
    {
        return config('larapanel.'.$panel);
    }

    public function getAdminConfig($panel, $admin)
    {
        return app('files')->getRequire(config_path('larapanel/'.$panel.'/'.$admin.'.php'));
    }

}