<?php

namespace Merix\LaraPanel\Core\Components;



class Action
{
    public $owner; // Panel or Admin

    public $name;
    public $handler;

    public $label;
    public $class;
    public $icon;
    public $tooltip;

    public $path; // Custom path for this action
    public $redirect; // Redirect instead of using ajax

    public $visible;
    public $allowed;


    public function __construct(
        $owner,
        $name, $handler, // System handling
        $label, $class = '', $icon = null, $tooltip ='', // Visuals
        $redirect = false, $path = null, // Custom handling
        $visible = true, $allowed = true // Permissions
    )
    {
        $this->owner = $owner;

        $this->name = $name;
        $this->handler = $handler;

        $this->label = $label;
        $this->class = $class;
        $this->icon = $icon;
        $this->tooltip = $tooltip;

        $this->path = $path;
        $this->redirect = $redirect;

        $this->visible = $visible;
        $this->allowed = $allowed;
    }

    public function call($data)
    {
        //TODO: Continue from here

        // handler($owner, $data, $actionManagement)
    }

    public function toArray()
    {
        //TODO: Continue from here

    }

}

