<?php

namespace Merix\LaraPanel\Backend\Laravel\Modules;

use Illuminate\Support\Collection;
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

    public function __construct($laraPanel, $panelName)
    {
        $this->laraPanel = $laraPanel;
        $this->panelName = $panelName;
    }


    private function parseMenu( $root, $parent = '')
    {
        static $id = 1;

        $name = val($root, 'name', 'menu_'.($id++));
        $admin = val($root, 'admin', '');

        $label = val($root, 'label', '');
        $class = val($root, 'class', '');

        $parent = val($root, 'admin', $parent);
        $children = val($root, 'children', []);

        $item = new Menu($this, $name, $label, $admin, $class);
        $item->parent = $parent;

        foreach($children as $child)
        {
            $item->children[] = $this->parseMenu($child, $name);
        }

        if($admin)
            $this->admins[] = $admin;

        $this->menu[$name] = $item;
        return $item;
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


        function parseAdmin($root)
        {
            $class = val($root, 'class', '');
            $label = val($root, 'label', '');
            $admin = val($root, 'admin', '');
            $parent = val($root, 'admin', '');
        }




        $this->admins = [];
        $this->menu = [];

//        $struct = $this->laraPanel->getConfig()->getValue('panel.admins', $this);
//        $this->admins = array_flatten($struct);


        $struct = $this->laraPanel->getConfig()->getValue('panel.menu', $this, []);
        foreach($struct as $item)
        {
            $this->parseMenu($item);
        }

        dump($this->admins);
        dump($this->menu);

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
        return $this->menu;
    }

    public function getActions()
    {
        // TODO: Implement getActions() method.
    }


}