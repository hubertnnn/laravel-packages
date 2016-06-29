<?php

namespace Merix\LaraPanel\Contracts;


interface ConfigurableContract
{
    public function getDefaultConfiguration();
    public function getConfiguration();

    public function configure($configData);
    public function getConfigPath();

}