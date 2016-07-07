<?php

namespace Merix\LaraPanel\Backend\Laravel;

use Merix\LaraPanel\Backend\Laravel\Modules\Config;
use Merix\LaraPanel\Backend\Laravel\Modules\Panel;
use Merix\LaraPanel\Backend\Laravel\Modules\Utils;
use Merix\LaraPanel\Core\Contracts\LaraPanel as BaseLaraPanel;

class LaraPanel implements BaseLaraPanel
{
    protected $config;
    protected $utils;

    protected $panel;
    protected $panelName;
    protected $admin;
    protected $adminName;


    public function __construct()
    {

    }

    /**
     * @return Admin
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    public function getAdminName()
    {
        return $this->adminName();
    }

    /**
     * @return Panel
     */
    public function getPanel()
    {
        if($this->panel == null)
        {
            $this->panel = new Panel($this, $this->panelName);
        }

        return $this->panel;
    }

    public function getPanelName()
    {
        return $this->panelName;
    }


    /**
     * @return Config
     */
    public function getConfig()
    {
        if($this->config == null)
        {
            $this->config = new Config($this);
        }
        return $this->config;
    }


    /** @return Utils */
    public function getUtils()
    {
        if($this->utils == null)
        {
            $this->utils = new Utils();
        }
        return $this->utils;
    }


    public function select($panel, $admin = null)
    {
        $this->panelName = $panel;
        $this->adminName = $admin;
    }


}