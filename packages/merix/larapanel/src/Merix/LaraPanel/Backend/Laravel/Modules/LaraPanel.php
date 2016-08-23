<?php

namespace Merix\LaraPanel\Backend\Laravel\Modules;

use Merix\LaraPanel\Backend\Laravel\Fields\FieldFactory;
use Merix\LaraPanel\Backend\Laravel\Managers\ConfigManager;
use Merix\LaraPanel\Core\Contracts\Modules\Config;
use Merix\LaraPanel\Core\Contracts\Modules\LaraPanel as BaseLaraPanel;

class LaraPanel implements BaseLaraPanel
{
    protected $config;
    protected $utils;

    protected $panel;
    protected $panelName;
    protected $admin;
    protected $adminName;

    protected $fieldFactory;


    public function __construct()
    {

    }

    /**
     * @return Admin
     */
    public function getAdmin()
    {
        if($this->admin == null)
        {
            $panel = $this->getPanel();
            if(in_array($this->getAdminName(), $panel->getAdmins()))
            {
                $this->admin = new Admin($this, $this->getAdminName());
            }
        }

        return $this->admin;
    }

    public function getAdminName()
    {
        return $this->adminName;
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
            $this->config = new ConfigManager($this);
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

    public function getLaraPanel()
    {
        return $this;
    }

    public function getFieldFactory()
    {
        if($this->fieldFactory == null)
        {
            $this->fieldFactory = new FieldFactory($this);
        }

        return $this->fieldFactory;
    }

    public function log($message, $type = 'DEBUG')
    {
        switch($type)
        {
            case 'DEBUG':
                \Log::debug($message);
                break;
            case 'INFO':
                \Log::info($message);
                break;
            case 'WARNING':
                \Log::warning($message);
                break;
            case 'ERROR':
                \Log::error($message);
                break;
            case 'CRITICAL':
                \Log::critical($message);
                break;
            default:
                \Log::debug($message);
                break;
        }
    }

}