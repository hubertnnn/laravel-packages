<?php

namespace Merix\LaraPanel\Backend\Laravel\Modules;

use Merix\LaraPanel\Core\Contracts\Modules\Config as BaseConfig;

class Config implements BaseConfig
{
    protected $laraPanel;

    private $panelDir = null;
    private $adminDir = null;


    public function __construct($laraPanel)
    {
        $this->laraPanel = $laraPanel;
    }


    private function translateKey($key)
    {
        if($this->panelDir == null)
        {
            $this->panelDir = config('larapanel.panel-dir');
            $this->adminDir = config('larapanel.admin-dir');
        }

        $parts = explode('.', $key, 2);

        switch($parts[0])
        {
            case 'global':
                return 'larapanel.' . $parts[1];
            case 'panel':
                return $this->panelDir . '.' . $this->laraPanel->getPanelName() . '.' . $parts[1];
            case 'admin':
                return $this->adminDir . '.' . $this->laraPanel->getAdminName() . '.'  . $parts[1];
            default:
                return $key; // If its not our just go on
        }

    }

    public function getClosure($key, $forceExists = false)
    {
        $key = $this->translateKey($key);

        $value = config($key);

        if(!($value instanceof \Closure))
            $value = null;

        if(($value === null) && $forceExists)
            return function($owner, $input){ return $input; };

        return null;
    }


    public function getValue($key, $owner = null, $default = null)
    {
        $key = $this->translateKey($key);

        $value = config($key, $default);

        if($value instanceof \Closure)
            return $value($owner);

        return $value;
    }

    public function getArray($key, $owner = null, $default = null)
    {
        return $this->getValue($key, $owner, $default);
    }

}