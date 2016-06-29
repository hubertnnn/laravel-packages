<?php

namespace Merix\LaraPanel\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Merix\LaraPanel\Admin;

class AdminController extends BaseController
{

    public function index()
    {
        $admin = new Admin();

//        dump(route('larapanel.index'));


        $parameters = [
            'admin' => $admin,
        ];


        return view('larapanel::panel', $parameters);
    }


    public function get()
    {
        return $this->index();
    }

}