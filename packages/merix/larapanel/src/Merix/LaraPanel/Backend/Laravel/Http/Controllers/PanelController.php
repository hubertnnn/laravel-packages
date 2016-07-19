<?php

namespace Merix\LaraPanel\Backend\Laravel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Merix\LaraPanel\Core\Components\Action;
use Merix\LaraPanel\Core\Contracts\LaraPanel;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PanelController extends Controller
{

    public function index(LaraPanel $laraPanel, $panel)
    {
        $laraPanel->select($panel);

        return 'html code of admin';
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
            'menu'      => $panel->getMenuStructure(),
            'actions'   => $panel->getActionStructure(),
        ];

        return $response;
    }

    public function action(Request $request, LaraPanel $laraPanel, $panel, $action)
    {
        $laraPanel->select($panel);
        $panel = $laraPanel->getPanel();


        $actions = $panel->getActions();
        if(!isset($actions[$action]))
        {
            throw new NotFoundHttpException();
        }

        /** @var Action $action */
        $action = $panel->getActions()[$action];
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
            $handler($panel, $data, $action);
        }

        return $action->getResponse();
    }

}