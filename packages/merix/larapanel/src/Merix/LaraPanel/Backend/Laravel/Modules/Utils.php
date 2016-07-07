<?php

namespace Merix\LaraPanel\Backend\Laravel\Modules;

use Merix\LaraPanel\Core\Contracts\Utils as BaseUtils;

class Utils implements BaseUtils
{
    public function call($callable, $parameters)
    {
        if($callable instanceof \Closure)
        {
            return call_user_func_array($callable, $parameters)
        }

        // Try to resolve this function using laravel
        if(is_string($callable))
        {
            $parts = explode('@', $this->handler, 2);
            if(count($parts) == 2)
            {
                $service = \App::make($parts[0]);
                return $service->$parts[1]($this->owner, $data, $this);
            }
        }

        return null;

    }


}