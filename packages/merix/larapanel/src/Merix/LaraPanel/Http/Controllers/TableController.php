<?php

namespace Merix\LaraPanel\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Collection;
use Merix\LaraPanel\Admin;
use Yajra\Datatables\Datatables;
use Yajra\Datatables\Engines\BaseEngine;

class TableController extends BaseController
{

    public function index()
    {



    }

    public function get(Request $request)
    {



        /** @var BaseEngine $datatables */
        $datatables = Datatables::of(User::all());
        return $datatables
            ->addIndexColumn()
            ->addRowData('aaa', function($object){ return 'bbb';})
            ->addColumn('other', function($object){
                return '';
            })
            ->make(true);
    }


}