<?php

namespace Merix\LaraPanel\Backend\Laravel\Modules;

use Illuminate\Support\Collection;
use Merix\LaraPanel\Core\Contracts\LaraPanel;
use Merix\LaraPanel\Core\Contracts\Modules\Panel as BasePanel;

class Panel implements BasePanel
{
    /** @var LaraPanel */
    protected $laraPanel;
    protected $panelName;

    protected $admins;
    protected $menu;

    public function __construct($laraPanel, $panelName)
    {
        $this->laraPanel = $laraPanel;
        $this->panelName = $panelName;
    }


    private function initMenu()
    {
        // If its already initiated
        if($this->admins != null)
            return;


        function val($list, $field, $default)
        {
            if(isset($list[$field]))
            {
                return $list[$field];
            }

            return $default;
        }



        $this->admins = [];
        $this->menu = [];

        $struct = $this->laraPanel->getConfig()->getValue('panel.admins', $this);
        $this->admins = array_flatten($struct);


        $struct = $this->laraPanel->getConfig()->getValue('panel.menu', $this);
        foreach($struct as $name => $menuItem)
        {
            $name = val($menuItem, 'name', $name);

            //TODO: Continue here / need a better parser

            $this->menu[$name] = [
                'label' => $name,
                'class' => '',
                'admin' => '',
                'menu' => [],
            ];


        }


    }



    public function getType()
    {
        return $this->laraPanel->getConfig()->getValue('panel.type', $this);
    }

    public function getTheme()
    {
        return $this->laraPanel->getConfig()->getValue('panel.theme', $this);
    }

    public function getResourceUrl()
    {
        return asset('vendor/merix/larapanel/');
    }

    public function getName()
    {
        return $this->laraPanel->getConfig()->getValue('panel.name', $this);
    }

    public function getIconUrl()
    {
        return $this->laraPanel->getConfig()->getValue('panel.icon', $this);
    }

    public function getFaviconUrl()
    {
        return $this->laraPanel->getConfig()->getValue('panel.favicon', $this, $this->getIconUrl());
    }

    public function getDefaultAdmin()
    {
        return $this->laraPanel->getConfig()->getValue('panel.default-admin', $this);
    }

    public function getAdminList()
    {
        $this->initMenu();
        return $this->admins;
    }

    public function getMenuStructure()
    {
        // TODO: Implement getMenuStructure() method.
    }

    public function getActions()
    {
        // TODO: Implement getActions() method.
    }


}