<?php

namespace Merix\LaraPanel\Core\Contracts\Components;



interface Field
{
    public function __construct($owner, $config, $parameters);
    public function getAdmin();

    // -----------------------------------------------------------------------------------------------------------------
    // Field location (shared between fields)

    // What is the field
    public function getName();
    public function getField();
    public function getLabel();

    // Where is the field
    public function getTab();   // Do we really need this?
    public function getSection();

    // Permissions
    public function getReadOnly();
    public function getDepends();

    //Validation
    public function getValidator();

    // -----------------------------------------------------------------------------------------------------------------
    // Proxy for easier access

    public function getObject();    // Return currently selected object



    // -----------------------------------------------------------------------------------------------------------------
    // Field logic

    // Return type of field
    public function getType();

    // Convert between json and real data
    public function serialize($data);
    public function deserialize($serialize);

    // Set value in object
    public function set($data);
    public function get();

    //TODO: Search
}

