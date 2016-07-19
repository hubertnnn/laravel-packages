<?php

namespace Merix\LaraPanel\Core\Contracts\Modules;



interface Admin
{

    public function getType();

    public function getName();
    public function getView();

    public function getActions();
    public function getActionStructure();

}
