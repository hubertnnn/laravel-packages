<?php

namespace Merix\LaraPanel\Contracts;


interface FieldContract
{
    /**
     * Renders the output of this field used in table
     * @param $value mixed current value of field
     * @param $entity mixed current entity
     * @param $admin \Merix\LaraPanel\Admin current admin
     * @return string html
     */
    public function output($value, $entity, $admin);

    /**
     * Renders this field in Edit page
     * @param $value
     * @param $entity
     * @param $admin
     * @return mixed
     */
    public function render($value, $entity, $admin);

    /**
     * Get field value in serializable format for sending to edit form
     * @param $value
     * @param $entity
     * @param $admin
     * @return mixed
     */
    public function get($value, $entity, $admin);

    /**
     * Deserialize field value and insert it into entity
     * @param $value
     * @param $entity
     * @param $admin
     * @return mixed
     */
    public function set($value, $entity, $admin);


    /**
     *
     * @param $value
     * @param $entity
     * @param $admin
     * @return mixed
     */
    public function search($value, $entity, $admin);


}