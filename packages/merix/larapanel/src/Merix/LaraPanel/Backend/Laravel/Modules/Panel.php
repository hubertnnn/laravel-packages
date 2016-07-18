<?php

namespace Merix\LaraPanel\Backend\Laravel\Modules;

use Illuminate\Support\Collection;
use Merix\LaraPanel\Core\Components\Action;
use Merix\LaraPanel\Core\Components\Menu;
use Merix\LaraPanel\Core\Contracts\LaraPanel;
use Merix\LaraPanel\Core\Contracts\Modules\Panel as BasePanel;

class Panel implements BasePanel
{
    /** @var LaraPanel */
    protected $laraPanel;
    protected $panelName;

    protected $admins;
    protected $menu;
    protected $actions;

    public function __construct($laraPanel, $panelName)
    {
        $this->laraPanel = $laraPanel;
        $this->panelName = $panelName;
    }


    private function parseMenu($root, $parent = null)
    {
        static $id = 1;

        foreach($root as $data)
        {
            $name = 'menu_m_'.($id++);
            $label = $data->getValue('label');
            $class = $data->getValue('class');
            $admin = $data->getValue('admin');
            $menu = $data->getNode('menu');

            $item = new Menu($this, $name, $label, $admin, $class);
            $item->parent = $parent;
            $this->menu[$name] = $item;

            if($menu != null)
            {
                $this->parseMenu($menu, $item);
            }

            if($admin != null)
            {
                $this->admins[] = $admin;
            }
        }
    }

    function parseAdmin($root, $parent = null)
    {
        static $id = 1;

        foreach($root as $label => $data)
        {
            $admin = $data->getValue();

            $name = 'menu_a_'.($id++);

            $item = new Menu($this, $name, $label, $admin);
            $item->parent = $parent;
            $this->menu[$name] = $item;

            if($admin != null)
            {
                $this->admins[] = $admin;
            }
            else
            {
                $this->parseAdmin($data, $item);
            }

        }
    }

    private function initMenu()
    {
        // If its already initiated
        if($this->admins != null)
            return;


        $this->admins = [];
        $this->menu = [];

        $adminsConfig = $this->laraPanel->getConfig()->getNode('panel.admins');
        $menuConfig = $this->laraPanel->getConfig()->getNode('panel.menu');

        // Parse menu from admins field
        if($adminsConfig !== null)
        {
            $this->parseAdmin($adminsConfig);
        }

        // Parse menu from menu field
        if($menuConfig !== null)
        {
            //TODO: Parse the other version of menu
            $this->parseMenu($menuConfig);
        }

        // Add children to menus based on parent field
        foreach($this->menu as $key => $menu)
        {
            if($menu->parent != null)
            {
                $menu->parent->children[] = $menu;
                unset($this->menu[$key]);
            }
        }
    }


    private function parseActions($root)
    {
        foreach($root as $data)
        {
            $name       = $data->getValue('name', $this);
            $label      = $data->getValue('label', $this, '');
            $class      = $data->getValue('class', $this, '');
            $icon       = $data->getValue('icon', $this, null);
            $tooltip    = $data->getValue('tooltip', $this, null);
            $path       = $data->getValue('path', $this, null);
            $redirect   = $data->getValue('redirect', $this, null);
            $visible    = $data->getValue('visible', $this, true);
            $allowed    = $data->getValue('allowed', $this, true);

            $handler    = $data->getClosure('handle');

            $action = new Action($this->laraPanel, $this, $name, $handler, $label, $class, $icon, $tooltip, $redirect, $path, $visible, $allowed);

            $this->actions[$name] = $action;
        }
    }

    private function parseActionPermissions($root)
    {
        foreach($root as $name => $data)
        {
            if(!isset($this->actions[$name]) || $this->actions[$name] == null)
            {
                // There is no such action
                continue;
            }

            $value = $data->getValue();

            // NULL = Not visible
            if($value === null)
            {
                $this->actions[$name]->visible = false;
                $this->actions[$name]->allowed = false;
            }

            // FALSE = Not allowed
            if($value === false)
            {
                $this->actions[$name]->visible = true;
                $this->actions[$name]->allowed = false;
            }

            // TRUE = Allowed
            if($value === true)
            {
                $this->actions[$name]->visible = true;
                $this->actions[$name]->allowed = true;
            }
        }
    }

    private function initActions()
    {
        // If its already initiated
        if($this->actions != null)
            return;

        $this->actions = [];

        $actionsConfig = $this->laraPanel->getConfig()->getNode('panel.custom-actions');
        $permissionsConfig = $this->laraPanel->getConfig()->getNode('panel.actions');

        $this->parseActions($actionsConfig);
        $this->parseActionPermissions($permissionsConfig);
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
        return asset($this->laraPanel->getConfig()->getValue('panel.icon', $this));
    }

    public function getFaviconUrl()
    {
        return asset($this->laraPanel->getConfig()->getValue('panel.favicon', $this, $this->getIconUrl()));
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
        $this->initMenu();

        $arr = [];
        foreach($this->menu as $item)
        {
            $arr[] = $item->toArray();
        }

        return $arr;
    }

    public function getActions()
    {
        $this->initActions();

        return $this->actions;
    }

    public function getActionStructure()
    {
        $this->initActions();

        $arr = [];
        foreach($this->actions as $item)
        {
            if($item->visible)
            {
                $arr[] = $item->toArray();
            }
        }

        return $arr;
    }

}