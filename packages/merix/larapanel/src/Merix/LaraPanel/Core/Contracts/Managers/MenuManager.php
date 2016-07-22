<?php

namespace Merix\LaraPanel\Core\Contracts\Managers;




interface MenuManager
{
    public function getPanel();

    public function getMenu();
    public function getAdmins();
    public function getStructure();
}
