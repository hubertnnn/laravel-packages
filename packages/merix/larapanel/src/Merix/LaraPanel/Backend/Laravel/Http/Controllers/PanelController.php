<?php

namespace Merix\LaraPanel\Backend\Laravel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Merix\LaraPanel\Core\Components\Action;
use Merix\LaraPanel\Core\Contracts\Modules\LaraPanel;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PanelController extends Controller
{

    public function index(LaraPanel $laraPanel, $panel)
    {
        $laraPanel->select($panel);

        return view('larapanel::index', ['larapanel' => $laraPanel]);
    }

    public function panel(LaraPanel $laraPanel, $panel)
    {
        $laraPanel->select($panel);

        $panel = $laraPanel->getPanel();

        $response = [
            'type'      => $panel->getType(),
            'theme'     => $panel->getTheme(),
            'name'      => $panel->getName(),
            'icon'      => $panel->getIconUrl(),
            'favicon'   => $panel->getFaviconUrl(),
            'default'   => $panel->getDefaultAdmin(),
            'menu'      => $panel->getMenu()->getStructure(),
            'actions'   => $panel->getActions()->getStructure(),
        ];

        return $response;
    }

    public function action(Request $request, LaraPanel $laraPanel, $panel, $action)
    {
        $laraPanel->select($panel);
        $panel = $laraPanel->getPanel();


        $action = $panel->getActions()->get($action);

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

}