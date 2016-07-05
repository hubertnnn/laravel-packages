<?php

namespace Merix\LaraPanel\Backend\Laravel\Modules;

use Merix\LaraPanel\Core\Contracts\Modules\Config as BaseConfig;

class Config implements BaseConfig
{

    public function getClosure($key, $forceExists = false)
    {
        $value = config($key);

        if(!($value instanceof \Closure))
            $value = null;

        if(($value === null) && $forceExists)
            return function($owner, $input){ return $input; };

        return null;
    }


    public function getValue($key, $owner = null)
    {
        $value = config($key);

        if($value instanceof \Closure)
            return $value($owner);

        return $value;
    }

}