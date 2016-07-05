<?php

namespace Merix\LaraPanel\Core\Contracts\Modules;



interface Config
{
    public function getClosure($key, $forceExists = false);
    public function getValue($key, $owner = null);
}
