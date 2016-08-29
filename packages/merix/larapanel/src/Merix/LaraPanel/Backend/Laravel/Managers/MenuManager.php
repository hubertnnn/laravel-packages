<?php

namespace Merix\LaraPanel\Backend\Laravel\Managers;

use Merix\LaraPanel\Backend\Laravel\Components\MenuItem;
use Merix\LaraPanel\Core\Contracts\Modules\Config;
use Merix\LaraPanel\Core\Contracts\Modules\Panel;
use Merix\LaraPanel\Core\Traits\PanelAwareTrait;

use Merix\LaraPanel\Core\Contracts\Managers\MenuManager as BaseMenuManager;

class MenuManager implements BaseMenuManager
{
    use PanelAwareTrait;

    /** @var  Config */
    protected $config;

    protected $menu;
    protected $admins;


    /**
     * @param $panel Panel
     * @param $config Config
     */
    public function __construct($panel, $config = null)
    {
        $this->panel = $panel;

        $this->config = $config;
    }

    public function init()
    {
        if($this->config == null)
        {
            $this->config = $this->getPanel()->getConfig();
        }

        $menuNode = $this->config->getNode('menu');
        if($menuNode != null)
        {
            $this->parseMenu($menuNode);
        }

        $adminsNode = $this->config->getNode('admins');
        if($adminsNode != null)
        {
            $this->parseAdmin($adminsNode);
        }
    }

    protected function parseMenu($root, $parent = null)
    {
        static $id = 1;

        foreach($root as $data)
        {
            /** @var Config $data */

            $name = 'menu_m_'.($id++);
            $label = $data->getValue('label');
            $class = $data->getValue('class');
            $admin = $data->getValue('admin');
            $menu = $data->getNode('menu');

            $action = $data->getNode('action');
            if($action != null)
            {
                $action = $this->getPanel()->getActions()->parseAction($action);
            }


            // Create MenuItem
            $item = new MenuItem($this, $name, $label, $admin, $class, $action);
            if($parent != null)
            {
                $item->setParent($parent);
            }

            // Add it to lists
            $this->menu[$name] = $item;
            if($admin != null)
            {
                $this->admins[] = $admin;
            }

            // Recurrency
            if($menu != null)
            {
                $this->parseMenu($menu, $item);
            }


        }
    }

    function parseAdmin($root, $parent = null)
    {
        static $id = 1;

        foreach($root as $label => $data)
        {
            /** @var Config $data */

            $admin = $data->getValue();

            $name = 'menu_a_'.($id++);

            // Create MenuItem
            $item = new MenuItem($this, $name, $label, $admin);
            if($parent != null)
            {
                $item->setParent($parent);
            }

            // Add it to lists
            $this->menu[$name] = $item;
            if($admin != null)
            {
                $this->admins[] = $admin;
            }
            else
            {
                // Recurrency
                $this->parseAdmin($data, $item);
            }

        }
    }



    public function getMenu()
    {
        if($this->menu == null)
            $this->init();

        return $this->menu;
    }

    public function getAdmins()
    {
        if($this->admins == null)
            $this->init();

        return $this->admins;
    }

    public function getStructure()
    {
        $arr = [];
        foreach($this->getMenu() as $item)
        {
            if($item->getParent() === null)
            {
                $arr[] = $item->toArray();
            }
        }

        return $arr;
    }


}