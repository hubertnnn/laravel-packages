<?php

namespace Merix\LaraPanel\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Merix\LaraPanel\Admin;

class AdminController extends BaseController
{

    public function index($panel)
    {
        $admin = new Admin(config('larapanel-panels.'.$panel));

        return redirect(route('larapanel.admin.page', ['panel' => $panel, 'key'=>$admin->getConfig('default') ]));
    }


    public function get($panel, $key)
    {
        $admin = new Admin(config('larapanel-panels.'.$panel));

        \View::share('panel', $panel);
        \View::share('key', $key);


        $parameters = [
            'admin' => $admin,
        ];

        return view('larapanel::panel', $parameters);
    }

}