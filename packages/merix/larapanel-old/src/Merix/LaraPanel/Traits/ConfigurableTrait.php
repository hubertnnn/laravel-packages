<?php

namespace Merix\LaraPanel\Traits;



trait ConfigurableTrait
{
    protected $configuration;

    public function getDefaultConfiguration()
    {
        return $this->defaultConfiguration;
    }

    public function getConfiguration()
    {
        if($this->configuration != null)
        {
            return $this->configuration;
        }

        $this->configure(config($this->getConfigPath()));

    }



}