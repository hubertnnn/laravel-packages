<?php

namespace Merix\LaraPanel\Core\Contracts\Factories;



interface FieldFactory
{

    public function registerField($type, $class, $defaultParameters = []);

    public function createField($owner, $type, $config, $parameters = []);

}

