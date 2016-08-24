<?php

namespace Merix\LaraPanel\Backend\Laravel\Modules;

use Illuminate\Support\Collection;
use Merix\LaraPanel\Backend\Laravel\Managers\ActionManager;
use Merix\LaraPanel\Backend\Laravel\Managers\MenuManager;
use Merix\LaraPanel\Core\Components\Action;
use Merix\LaraPanel\Core\Components\Menu;
use Merix\LaraPanel\Core\Contracts\Modules\Panel as BasePanel;
use Merix\LaraPanel\Core\Traits\LaraPanelAwareTrait;
use Merix\LaraPanel\Core\Traits\OwnerAwareTrait;

class Panel implements BasePanel
{
    use OwnerAwareTrait;
    use LaraPanelAwareTrait;

    protected $panelName;

    protected $config;

    protected $admins;
    protected $menu;
    protected $actions;

    public function __construct($laraPanel, $panelName)
    {
        $this->owner = $laraPanel;
        $this->laraPanel = $laraPanel;
        $this->panelName = $panelName;

        $this->config = $this->getLaraPanel()->getConfig()->getNode('panel');
    }



    //------------------------------------------------------------------------------------------------------------------
    // Initialization

    protected function initMenu()
    {
        $this->menu = new MenuManager($this, $this->getConfig());
        $this->admins = $this->menu->getAdmins();
    }

    protected function initActions()
    {
        $this->actions = new ActionManager($this, $this->getConfig());
    }



    //------------------------------------------------------------------------------------------------------------------
    // Getters

    public function getConfig()
    {
        return $this->getLaraPanel()->getConfig()->getNode('panel');
    }


    public function getDefaultAdmin()
    {
        return $this->getConfig()->getValue('default-admin', $this);
    }

    public function getAdmins()
    {
        if($this->admins == null)
        {
            $this->initMenu();
        }

        return $this->admins;
    }

    public function getMenu()
    {
        if($this->menu == null)
        {
            $this->initMenu();
        }

        return $this->menu;
    }

    public function getActions()
    {
        if($this->actions == null)
        {
            $this->initActions();
        }

        return $this->actions;
    }


    public function getName()
    {
        return $this->getConfig()->getValue('name', $this);
    }

    public function getType()
    {
        return $this->getConfig()->getValue('type', $this);
    }

    public function getTheme()
    {
        return $this->getConfig()->getValue('theme', $this);
    }

    public function getIconUrl()
    {
        return asset($this->getConfig()->getValue('icon', $this));
    }

    public function getFaviconUrl()
    {
        return asset($this->getConfig()->getValue('favicon', $this, $this->getIconUrl()));
    }


    public function getResourceUrl()
    {
        return asset('vendor/larapanel/');
    }

}