<?php

namespace Merix\LaraPanel\Backend\Laravel\Modules;

use Illuminate\Support\Collection;
use Merix\LaraPanel\Core\Components\Action;
use Merix\LaraPanel\Core\Components\Menu;
use Merix\LaraPanel\Core\Contracts\LaraPanel;
use Merix\LaraPanel\Core\Contracts\Modules\Admin as BaseAdmin;

class Admin implements BaseAdmin
{
    /** @var LaraPanel */
    protected $laraPanel;

    protected $name;
    protected $type;
    protected $view;

    protected $actions;

    public function __construct($laraPanel, $panelName)
    {
        $this->laraPanel = $laraPanel;
        $this->panelName = $panelName;
    }


    private function initPanel()
    {
        // If its already initiated
        if($this->name != null)
            return;

        $config = $this->laraPanel->getConfig()->getNode('admin');

        $this->name = $config->getValue('name');
        $this->type = $config->getValue('type');
        $this->view = $config->getValue('view');

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

        $actionsConfig = $this->laraPanel->getConfig()->getNode('admin.custom-actions');
        $permissionsConfig = $this->laraPanel->getConfig()->getNode('admin.actions');

        $this->parseActions($actionsConfig);
        $this->parseActionPermissions($permissionsConfig);
    }




    public function getType()
    {
        $this->initPanel();
        return $this->type;
    }

    public function getName()
    {
        $this->initPanel();
        return $this->name;
    }

    public function getView()
    {
        $this->initPanel();
        return $this->view;
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