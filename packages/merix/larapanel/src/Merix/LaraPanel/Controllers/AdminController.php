<?php

namespace Merix\LaraPanel\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Merix\LaraPanel\Admin;
use Merix\LaraPanel\Panel;

class AdminController extends BaseController
{

    public function index($panelName)
    {
        $panel = new Panel($panelName);
        $adminName = $panel->getDefaultAdmin();

        return redirect(route('larapanel.admin.page', ['panel' => $panelName, 'key'=> $adminName]));
    }


    public function get($panelName, $adminName)
    {
        $panel = new Panel($panelName);
        $admin = new Admin($panel, $adminName);


    }

}