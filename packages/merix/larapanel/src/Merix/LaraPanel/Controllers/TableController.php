<?php

namespace Merix\LaraPanel\Controllers;

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
        $list = [];

//        for($i=0; $i<500; $i++)
//        {
//            $user = new User();
//            $user->name = 'Adam '. $i;
//            $user->email = 'aaa'.$i.'@bbb.ccc';
//            $user->save();
//        }





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