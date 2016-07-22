<?php

namespace Merix\LaraPanel\Core\Contracts\Modules;



use Merix\LaraPanel\Core\Contracts\Interfaces\Module;
use Merix\LaraPanel\Core\Contracts\Managers\ActionManager;

interface Edit extends Module
{
    public function getAdmin();
    public function getObject();

    public function getWidth();
    public function getTabs();
    public function getSections();
    public function getFields();

    /** @return ActionManager */
    public function getActions();
    public function getActionStructure();

    public function select($id);
}
