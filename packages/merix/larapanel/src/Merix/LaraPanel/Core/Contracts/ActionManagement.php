<?php

namespace Merix\LaraPanel\Core\Contracts;
use Merix\LaraPanel\Core\Contracts\Modules\Config;
use Merix\LaraPanel\Core\Contracts\Modules\Panel;
use Merix\LaraPanel\Core\Contracts\Modules\Admin;


interface ActionManagement
{
    public function refresh();                                              // Force a refresh on current data
    public function redirect($path);                                        // Force a redirect to other page
    public function openEdit($adminName, $id);
    public function closeEdit();
    public function fillField($field, $value);                              // Fill a field with following value
    public function fillFields($fields = null);                             // If null fill everything with current data, else its an array of key-value pairs
    public function error($field, $message);
    public function errors($fields);
    public function message($label, $message, $class = '', $time = 2000);   // Show a message to user
    public function popup($label, $message, $class = '', $button = 'OK');   // Show a popup to user
}