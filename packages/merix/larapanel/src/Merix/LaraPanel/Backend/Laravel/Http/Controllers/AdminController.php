<?php

namespace Merix\LaraPanel\Backend\Laravel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Merix\LaraPanel\Core\Contracts\Modules\LaraPanel;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdminController extends Controller
{

    public function admin(Request $request, LaraPanel $laraPanel, $panel, $admin)
    {
        $laraPanel->select($panel, $admin);
        $panel = $laraPanel->getPanel();
        $admin = $laraPanel->getAdmin();

        if($admin == null)
        {
            throw new NotFoundHttpException();
        }

        $response = [
            'type'      => $admin->getType(),
            'name'      => $admin->getName(),
            'view'      => $admin->getView(),
            'actions'   => $admin->getActions()->getStructure(),
        ];

        return $response;
    }


    public function action(Request $request, LaraPanel $laraPanel, $panel, $admin, $action)
    {
        $laraPanel->select($panel, $admin);
        $panel = $laraPanel->getPanel();
        $admin = $laraPanel->getAdmin();

        $action = $admin->getActions()->get($action);

        if(($action == null) || (!$action->getVisible()))
        {
            throw new NotFoundHttpException();
        }

        if(!$action->getAllowed())
        {
            \App::abort(403, 'Unauthorized action.');
        }

        $data = $request->input('data', []);

        $action->call($data);

        return $action->getResponse();
    }


    public function edit(Request $request, LaraPanel $laraPanel, $panel, $admin)
    {
        $laraPanel->select($panel, $admin);
        $panel = $laraPanel->getPanel();
        $admin = $laraPanel->getAdmin();

        if($admin == null)
        {
            throw new NotFoundHttpException();
        }

        $edit  = $admin->getEdit();

        $response = [
            'width'     => $edit->getWidth(),
            'tabs'      => $edit->getTabs(),
            'sections'  => $edit->getSections(),
            'fields'    => $edit->getFields(),
            'actions'   => $edit->getActions()->getStructure(),
        ];

        return $response;

    }

}