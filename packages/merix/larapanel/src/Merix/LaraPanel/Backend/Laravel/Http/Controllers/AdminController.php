<?php

namespace Merix\LaraPanel\Backend\Laravel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Merix\LaraPanel\Core\Contracts\LaraPanel;
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
            'actions'   => $admin->getActionStructure(),
        ];

        return $response;
    }


    public function action(Request $request, LaraPanel $laraPanel, $panel, $admin, $action)
    {
        $laraPanel->select($panel, $admin);
        $panel = $laraPanel->getPanel();
        $admin = $laraPanel->getAdmin();

        if($admin == null)
        {
            throw new NotFoundHttpException();
        }


        $actions = $admin->getActions();
        if(!isset($actions[$action]))
        {
            throw new NotFoundHttpException();
        }

        /** @var Action $action */
        $action = $admin->getActions()[$action];
        if(!$action->visible)
        {
            throw new NotFoundHttpException();
        }

        if(!$action->allowed)
        {
            \App::abort(403, 'Unauthorized action.');
        }

        $data = $request->input('data', []);

        $handler = $action->handler;
        if($handler != null)
        {
            $handler($admin, $data, $action);
        }

        return $action->getResponse();
    }

}