<?php

namespace Merix\LaraPanel\Core\Contracts\Modules;



use Merix\LaraPanel\Backend\Laravel\Managers\MenuManager;
use Merix\LaraPanel\Core\Contracts\Interfaces\Module;
use Merix\LaraPanel\Core\Contracts\Managers\ActionManager;

interface Panel extends Module
{


    // Type and theme used for styling of admin
    public function getType();
    public function getTheme();

    /** @return string Uri to root directory of admin frontend */
    public function getResourceUrl();



    public function getName();
    public function getIconUrl();
    public function getFaviconUrl();


    public function getDefaultAdmin();
    public function getAdmins();

    /** @return MenuManager */
    public function getMenu();

    /** @return ActionManager */
    public function getActions();

}
