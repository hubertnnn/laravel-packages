<?php

abstract class Field
{
    /**
     * Renders the output of this field used in table
     * @param $value mixed current value of field
     * @param $entity mixed current entity
     * @param $admin \Merix\LaraPanel\Admin current admin
     * @return string html
     */
    public abstract function output($value, $entity, $admin);

    /**
     * Renders this field in Edit page
     * @param $value
     * @param $entity
     * @param $admin
     * @return mixed
     */
    public abstract function render($value, $entity, $admin);
    public abstract function get($value, $entity, $admin);
    public abstract function set($value, $entity, $admin);

    public abstract function search($value, $entity, $admin);

}