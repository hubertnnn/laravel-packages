<?php

namespace Merix\LaraPanel\Core\Contracts\Components;



interface Action
{
    public function getName();
    public function getOwner();

    // Style
    public function getLabel();
    public function getTooltip();
    public function getIcon();
    public function getClass();

    // Functions
    public function getRedirect();
    public function getPath();

    // Permissions
    public function getVisible();
    public function getAllowed();

    // Handler
    public function call($data);

    // Serialization
    public function toArray();
}

