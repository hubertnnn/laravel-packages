<?php

namespace Merix\LaraPanel\Core\Contracts\Modules;



use Merix\LaraPanel\Core\Contracts\Module;

interface Edit extends Module
{

    public function getAdmin();

    public function getWidth();
    public function getTabs();
    public function getSections();
    public function getFields();

    public function getActions();
    public function getActionStructure();

}
