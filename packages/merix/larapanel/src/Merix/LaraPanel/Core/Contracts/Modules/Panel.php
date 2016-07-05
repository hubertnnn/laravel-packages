<?php

namespace Merix\LaraPanel\Core\Contracts\Modules;



interface Panel
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
    public function getAdminList();
    public function getMenuStructure();

    public function getActions();

}
