<?php

namespace Merix\LaraPanel\Core\Contracts\Managers;



use Merix\LaraPanel\Core\Contracts\Components\Field;

interface FieldManager
{
    public function getOwner();

    /** @return Action */
    public function get($name);
    public function getActions();
    public function getStructure();
}
