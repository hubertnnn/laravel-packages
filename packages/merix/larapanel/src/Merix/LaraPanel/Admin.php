<?php

namespace Merix\LaraPanel;


class Admin
{
    protected $settings;

    public function __construct($settings = null)
    {
        $this->settings = $settings;
    }


    public function getName()
    {
        return 'Admin';
    }

    public function getMenu()
    {
        return $this->settings['admins'];
    }

    public function getConfig($key)
    {
        return $this->settings[$key];
    }




    public function getPanelName()
    {


    }

    public function getAdminName()
    {

    }

}