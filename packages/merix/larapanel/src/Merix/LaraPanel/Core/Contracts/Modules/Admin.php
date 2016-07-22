<?php

namespace Merix\LaraPanel\Core\Contracts\Modules;



use Merix\LaraPanel\Core\Contracts\Interfaces\Module;
use Merix\LaraPanel\Core\Contracts\Managers\ActionManager;

interface Admin extends Module
{

    public function getType();

    public function getName();
    public function getView();

    /** @return ActionManager */
    public function getActions();


    // Edit window
    public function getEdit();
    public function getFields();

}
