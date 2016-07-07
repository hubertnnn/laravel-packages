<?php

namespace Merix\LaraPanel\Backend\Laravel\Http\Controllers;

use Illuminate\Routing\Controller;
use Merix\LaraPanel\Core\Contracts\LaraPanel;

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
            'actions'   => $panel->getActions(),
        ];

        return $response;
    }

    public function action(LaraPanel $laraPanel, $panel, $action)
    {
        return 'aaa';
    }

}