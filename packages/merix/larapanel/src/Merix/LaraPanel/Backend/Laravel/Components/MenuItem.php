<?php

namespace Merix\LaraPanel\Backend\Laravel\Components;

use Merix\LaraPanel\Core\Contracts\Modules\Config;
use Merix\LaraPanel\Core\Contracts\Components\MenuItem as BaseMenuItem;

class MenuItem implements BaseMenuItem
{
    protected $manager;

    protected $name;

    protected $admin;
    protected $action;

    protected $label;
    protected $class;

    protected $parent;
    protected $children;


    public function __construct($manager, $name, $label, $admin = null, $class = null, $action = null)
    {
        $this->manager = $manager;

        $this->name = $name;
        $this->admin = $admin;

        $this->label = $label;
        $this->class = $class;

        $this->parent = null;
        $this->children = [];
    }

    /**
     * @param $parent MenuItem
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
        $parent->addChild($this);
    }

    /**
     * @param $child MenuItem
     */
    public function addChild($child)
    {
        $this->children[] = $child;
    }




    // Getters

    public function getName()
    {
        return $this->name;
    }

    public function getAdmin()
    {
        return $this->admin;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getClass()
    {
        return $this->class;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function toArray()
    {
        $childrenArray = [];

        foreach($this->children as $child)
        {
            $childrenArray[] = $child->toArray();
        }

        return [
            'admin' => $this->admin,
            'action' => $this->action,

            'label' => $this->getLabel() ? $this->getLabel() : '',
            'class' => $this->getLabel() ? $this->getLabel() : '',

            'menu' => empty($childrenArray) ? null : $childrenArray,
        ];
    }


}