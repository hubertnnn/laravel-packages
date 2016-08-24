<?php

namespace Merix\LaraPanel\Backend\Laravel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Merix\LaraPanel\Core\Contracts\Components\DownloadableField;
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
            'fields'    => array_values(array_map(function($field){return $field->getStructure();}, $edit->getFields())),
            'actions'   => $edit->getActions()->getStructure(),
        ];

        return $response;

    }

    public function get(Request $request, LaraPanel $laraPanel, $panel, $admin, $id)
    {
        $laraPanel->select($panel, $admin);
        $panel = $laraPanel->getPanel();
        $admin = $laraPanel->getAdmin();

        if($admin == null)
        {
            throw new NotFoundHttpException();
        }

        $admin->getEdit()->select($id);


        if(!$request->isXmlHttpRequest()){
            //TODO: Show admin page and select $id
        }


        $response = [
            'fields' => $admin->getEdit()->getData(),
            'actions' => [], //TODO: Per field action permissions
        ];

        return $response;
    }


    public function store(Request $request, LaraPanel $laraPanel, $panel, $admin, $id)
    {
        $laraPanel->select($panel, $admin);
        $panel = $laraPanel->getPanel();
        $admin = $laraPanel->getAdmin();

        if($admin == null)
        {
            throw new NotFoundHttpException();
        }

        $admin->getEdit()->select($id);


        $response = $admin->getEdit()->storeData($request->input());

        return $response;

    }

    public function download(Request $request, LaraPanel $laraPanel, $panel, $admin, $id, $field, $type = null)
    {
        $laraPanel->select($panel, $admin);
        $panel = $laraPanel->getPanel();
        $admin = $laraPanel->getAdmin();

        if($admin == null)
        {
            throw new NotFoundHttpException();
        }

        if(!$admin->getEdit()->select($id))
        {
            throw new NotFoundHttpException();
        }

        $field = $admin->getEdit()->getField($field);

        if(($field == null) || !($field instanceof DownloadableField))
        {
            throw new NotFoundHttpException();
        }

        return $field->getDownload($type);
    }

}