<?php

namespace Merix\LaraPanel\Core\Contracts\Components;



interface Field
{
    public function __construct($owner, $config, $parameters);

    public function getAdmin();

    // What is the field
    public function getType();
    public function getName();
    public function getField();
    public function getLabel();

    // Where is the field
    public function getTab();   // Do we really need this?
    public function getSection();

    // Permissions
    public function getReadOnly();
    public function getDepends();

    // Return structure used by js to render the field
    public function getStructure();

    public function read();         // Return json serialized value for field
    public function write($value);  // Set value of field to this serialized value
    public function search($data);  // Do some local communication between field frontend and backend

    public function getObject();    // Return currently selected object
}

