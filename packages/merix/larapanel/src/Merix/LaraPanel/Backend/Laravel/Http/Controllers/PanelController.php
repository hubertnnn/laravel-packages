<?php

namespace Merix\LaraPanel\Backend\Laravel\Http\Controllers;

use Illuminate\Routing\Controller;
use Merix\LaraPanel\Core\Contracts\LaraPanel;

class PanelController extends Controller
{

    public function index(LaraPanel $laraPanel, $panel)
    {
        return 'html code of admin';
    }

    public function panel(LaraPanel $laraPanel, $panel)
    {
        $laraPanel->loadPanel($panel);



        return 'aaa';
    }

    public function action(LaraPanel $laraPanel, $panel, $action)
    {
        return 'aaa';
    }

}