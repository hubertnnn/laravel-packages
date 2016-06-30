<?php

namespace Merix\LaraPanel;


use Merix\LaraPanel\Contracts\PanelContract;

class Panel implements PanelContract
{
    protected $uri;
    protected $title;
    protected $theme;


    public function __construct($panelName)
    {

    }


    public function getUri()
    {
        // TODO: Implement getUri() method.
    }

    public function getTitle()
    {
        // TODO: Implement getTitle() method.
    }

    public function getTheme()
    {
        // TODO: Implement getTheme() method.
    }

    public function getMiddleware()
    {
        // TODO: Implement getMiddleware() method.
    }

    public function getPermission()
    {
        // TODO: Implement getPermission() method.
    }

    public function getMenu()
    {
        // TODO: Implement getMenu() method.
    }

    public function getBackToSitePath()
    {
        // TODO: Implement getBackToSitePath() method.
    }

    public function getLoginPath()
    {
        // TODO: Implement getLoginPath() method.
    }

    public function getLogoutPath()
    {
        // TODO: Implement getLogoutPath() method.
    }

    public function getLocales()
    {
        // TODO: Implement getLocales() method.
    }

    public function getDefaultAdmin()
    {
        // TODO: Implement getDefaultAdmin() method.
    }


}