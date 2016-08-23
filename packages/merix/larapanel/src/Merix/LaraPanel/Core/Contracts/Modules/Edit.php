<?php

namespace Merix\LaraPanel\Core\Contracts\Modules;



use Merix\LaraPanel\Core\Contracts\Components\Field;
use Merix\LaraPanel\Core\Contracts\Interfaces\Module;
use Merix\LaraPanel\Core\Contracts\Managers\ActionManager;

interface Edit extends Module
{
    // Access admin
    public function getAdmin();

    // How it should look
    public function getWidth();
    public function getTabs();
    public function getSections();

    // How it should work
    /** @return Field[] */
    public function getFields();
    /** @return ActionManager */
    public function getActions();

    // Object instance management
    public function select($id);
    public function getObject();

    public function getData();
}
