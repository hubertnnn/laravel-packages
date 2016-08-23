<?php

namespace Merix\LaraPanel\Backend\Laravel\Managers;

use Merix\LaraPanel\Backend\Laravel\Components\Action;
use Merix\LaraPanel\Core\Contracts\Managers\ActionManager as BaseActionManager;
use Merix\LaraPanel\Core\Contracts\Modules\Admin;
use Merix\LaraPanel\Core\Contracts\Modules\Config;
use Merix\LaraPanel\Core\Contracts\Modules\Panel;
use Merix\LaraPanel\Core\Traits\OwnerAwareTrait;

class ActionManager implements BaseActionManager
{
    use OwnerAwareTrait;

    protected $actions;


    /**
     * @param $owner Admin|Panel
     * @param $config
     */
    public function __construct($owner, $config)
    {
        $this->owner = $owner;

        $this->init($config);
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
        $name       = $data->getValue('name', $this->getOwner());
        $label      = $data->getValue('label', $this->getOwner(), '');
        $class      = $data->getValue('class', $this->getOwner(), '');
        $icon       = $data->getValue('icon', $this->getOwner(), null);
        $tooltip    = $data->getValue('tooltip', $this->getOwner(), null);
        $path       = $data->getValue('path', $this->getOwner(), null);
        $redirect   = $data->getValue('redirect', $this->getOwner(), null);
        $visible    = $data->getValue('visible', $this->getOwner(), true);
        $allowed    = $data->getValue('allowed', $this->getOwner(), true);

        $handler    = $data->getClosure('handle');

        $action = new Action($this->owner->getLaraPanel(), $this->getOwner(), $name, $handler, $label, $class, $icon, $tooltip, $redirect, $path, $visible, $allowed);

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