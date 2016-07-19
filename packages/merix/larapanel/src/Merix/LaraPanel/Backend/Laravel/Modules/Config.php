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
        $rest = '';
        if(count($parts) > 1)
        {
            $rest = '.' . $parts[1];
        }

        switch($parts[0])
        {
            case 'global':
                return 'larapanel.' . $parts[1];
            case 'panel':
                return $this->panelDir . '.' . $this->laraPanel->getPanelName() . $rest;
            case 'admin':
                return $this->adminDir . '.' . $this->laraPanel->getAdminName() . $rest;
            default:
                return $key; // If its not our just go on
        }

    }

    /** Check if node exists */
    public function exists($key = null)
    {
        $key = $this->translateKey($key);
        return app('config')->has($key);
    }

    /** Check return the subnode */
    public function getNode($key = null, $nullIfEmpty = true)
    {
        if($nullIfEmpty && !$this->exists($key))
        {
            return null;
        }
        return new ConfigNode($this, $key);
    }


    /** Return the node as closure */
    public function getClosure($key = null, $forceExists = false)
    {
        if($this->exists($key))
        {
            $key = $this->translateKey($key);
            $closure = config($key);

            if(is_callable($closure))
            {
                return $closure;
            }

            if(is_array($closure) && (count($closure) == 1) && isset($closure[0]) && is_string($closure[0]))
            {
                $closure = explode('@', $closure[0]);
                if(count($closure) == 2)
                {
                    $object = app()->make($closure[0]);
                    $closure = [$object, $closure[1]];

                    return function($closure) use($closure)
                    {
                        $args = func_get_args();
                        return call_user_func_array($closure, $args);
                    };

                }
            }
        }


        if($forceExists)
        {
            return function($arg1)
            {
                return $arg1;
            };
        }

        return null;
    }

    /** Return the node as value */
    public function getValue($key = null, $owner = null, $default = null)
    {
        if(!$this->exists($key))
        {
            return $default;
        }

        $value = config($this->translateKey($key));

        // If its a closure, call it
        if((!is_string($value) && is_callable($value)) || is_array($value))
        {
            $closure = $this->getClosure($key);
            if($closure != null)
            {
                return $closure($owner);
            }

            // Its not a value, so return default
            return $default;
        }

        return $value;
    }

    /** Return the node as array */
    public function getArray($key = null, $owner = null, $default = null)
    {
        if(!$this->exists($key))
        {
            return $default;
        }

        $value = config($this->translateKey($key));

        // If its a closure, call it
        if((!is_string($value) && is_callable($value)) || is_array($value))
        {
            $closure = $this->getClosure($key);
            if($closure != null)
            {
                return $closure($owner);
            }
        }

        // If its not an array, return default
        if(!is_array($value))
        {
            return $default;
        }

        // Return the array
        return $value;
    }


}