<?php

namespace Merix\LaraPanel\Core\Contracts\Managers;



use Merix\LaraPanel\Core\Contracts\Components\Action;

interface ActionManager
{
    public function getOwner();

    /** @return Action */
    public function get($name);
    public function getActions();
    public function getStructure();
}
