<?php

namespace Merix\LaraPanel\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Merix\LaraPanel\Admin;
use Merix\LaraPanel\Services\ConfigService;
use Yajra\Datatables\Datatables;
use Yajra\Datatables\Engines\BaseEngine;

class TestController extends BaseController
{

    public function index()
    {

        $configService = new ConfigService();

        dump($configService->getGlobalConfig());
        dump($configService->getPanelConfig('admin'));
        dump($configService->getAdminConfig('admin', 'aaa'));




//        $config = app('files')->getRequire(config_path('larapanel/admin/aaa.php'));

//        $config = Config::get('larapanel.admin');
//
//        $config = config('larapanelaa');

//        dump(get_class(config()));
//
//        dump($config);
        die();




    }

}