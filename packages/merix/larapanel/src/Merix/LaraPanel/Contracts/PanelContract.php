<?php

namespace Merix\LaraPanel\Contracts;


interface PanelContract
{
    public function getUri();
    public function getTitle();
    public function getTheme();

    public function getMiddleware();
    public function getPermission();

    public function getMenu();
    public function getBackToSitePath();
    public function getLoginPath();
    public function getLogoutPath();

    public function getLocales();


}