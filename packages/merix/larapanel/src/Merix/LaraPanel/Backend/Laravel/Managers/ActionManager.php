<?php

namespace Merix\LaraPanel\Backend\Laravel\Managers;

use Merix\LaraPanel\Backend\Laravel\Components\Action;
use Merix\LaraPanel\Core\Contracts\Managers\ActionManager as BaseActionManager;
use Merix\LaraPanel\Core\Contracts\Modules\Config;

class ActionManager implements BaseActionManager
{
    protected $owner;

    protected $actions;


    public function __construct($owner, $config)
    {
        $this->owner = $owner;

        $this->init($owner->getConfig());
    }

    protected function init(Config $config)
    {
        if($this->actions != null)
            return;

        $actionsConfig = $config->getNode('custom-actions');
        $permissionsConfig = $config->getNode('actions');

        $this->parseActions($actionsConfig);
        $this->parseActionPermissions($permissionsConfig);
    }


    /**
     * @param $data
     * @return Action
     */
    public function parseAction($data)
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

        $action = new Action($this->owner->getLaraPanel(), $this->owner, $name, $handler, $label, $class, $icon, $tooltip, $redirect, $path, $visible, $allowed);

        return $action;
    }


    private function parseActions($root)
    {
        foreach($root as $data)
        {
            $action = $this->parseAction($data);

            $this->actions[$action->getName()] = $action;
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
                $this->actions[$name]->setPermissions(false, false);
            }

            // FALSE = Not allowed
            if($value === false)
            {
                $this->actions[$name]->setPermissions(true, false);
            }

            // TRUE = Allowed
            if($value === true)
            {
                $this->actions[$name]->setPermissions(true, true);
            }
        }
    }



    public function getOwner()
    {
        return $this->owner;
    }

    public function get($name)
    {
        $actions = $this -> getActions();

        if(isset($actions[$name]))
        {
            return $actions[$name];
        }

        return null;
    }

    public function getActions()
    {
        return $this->actions;
    }

    public function getStructure()
    {
        $arr = [];
        foreach($this->getActions() as $item)
        {
            /** @var Action $item */
            if($item->getVisible())
            {
                $arr[] = $item->toArray();
            }
        }

        return $arr;
    }

    public function toArray()
    {
        return $this->getStructure();
    }


}