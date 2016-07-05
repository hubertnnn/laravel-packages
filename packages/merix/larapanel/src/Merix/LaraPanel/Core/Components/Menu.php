<?php

namespace Merix\LaraPanel\Core\Components;



class Menu
{
    public $panel;

    public $name;
    public $admin;

    public $label;
    public $class;

    public $parent;
    public $children;


    public function __construct($panel, $name, $label, $admin = null, $class = null)
    {
        $this->panel = $panel;

        $this->name = $name;
        $this->admin = $admin;

        $this->label = $label;
        $this->class = $class;

        $this->parent = null;
        $this->children = [];
    }

    public function setupChildren($allMenuItems)
    {
        $allMenuItems[$this->parent]->children[] = $this;
    }

    public function toArray()
    {
        $childrenArray = [];

        foreach($this->children as $child)
        {
            $childrenArray[] = $child->toArray();
        }

        return [
            'label' => $this->label ? $this->label : '',
            'class' => $this->class ? $this->class : '',

            'admin' => $this->admin,
            'menu' => empty($childrenArray) ? null : $childrenArray,
        ];
    }

}

