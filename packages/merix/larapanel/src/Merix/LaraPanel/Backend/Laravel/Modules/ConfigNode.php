<?php

namespace Merix\LaraPanel\Backend\Laravel\Modules;

use \Merix\LaraPanel\Core\Contracts\Modules\ConfigNode as BaseConfigNode;

class ConfigNode implements BaseConfigNode
{
    /** @var Config */
    protected $config;

    /** @var  string */
    protected $path;

    public function __construct($config, $path)
    {
        $this->config = $config;
        $this->path = $path;
    }


    public function exists($key = null)
    {
        if($key == '' || $key == null)
        {
            // We are in curent node, get result
            return  $this->config->exists($this->path);
        }
        else
        {
            // We need to get the node
            $this->getNode($key, false)->exists('');
        }
    }

    public function getNode($key = null, $nullIfEmpty = true)
    {
        if($nullIfEmpty)
        {
            if($this->exists($key))
            {
                return $this->getNode($key, false);
            }
            else
            {
                return null;
            }

        }
        else
        {
            return new ConfigNode($this->config, $this->path . '.' . $key);
        }
    }


    public function getClosure($key = null, $forceExists = false)
    {
        if($key == '' || $key == null)
        {
            // We are in curent node, get result
            return  $this->config->getClosure($this->path, $forceExists);
        }
        else
        {
            // We need to get the node
            $this->getNode($key, false)->getClosure('', $forceExists = false);
        }
    }

    public function getValue($key = null, $owner = null, $default = null)
    {
        if($key == '' || $key == null)
        {
            // We are in curent node, get result
            return  $this->config->getValue($this->path, $owner, $default);
        }
        else
        {
            // We need to get the node
            $this->getNode($key, false)->getValue('', $forceExists = false);
        }
    }

    public function getArray($key = null, $owner = null, $default = null)
    {
        if($key == '' || $key == null)
        {
            // We are in curent node, get result
            return  $this->config->getArray($this->path, $owner, $default);
        }
        else
        {
            // We need to get the node
            $this->getNode($key, false)->getArray('', $forceExists = false);
        }
    }



}
