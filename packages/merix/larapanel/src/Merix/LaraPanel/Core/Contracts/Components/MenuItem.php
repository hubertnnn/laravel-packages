<?php

namespace Merix\LaraPanel\Core\Contracts\Components;



interface MenuItem
{

    public function getName();

    public function getAdmin();
    public function getAction();

    public function getLabel();
    public function getClass();

    public function getParent();
    public function getChildren();

    public function toArray();

}

