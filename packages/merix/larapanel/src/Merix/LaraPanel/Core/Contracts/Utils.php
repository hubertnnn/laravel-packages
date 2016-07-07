<?php

namespace Merix\LaraPanel\Core\Contracts;
use Merix\LaraPanel\Core\Contracts\Modules\Config;
use Merix\LaraPanel\Core\Contracts\Modules\Panel;
use Merix\LaraPanel\Core\Contracts\Modules\Admin;


/**
 * Interface Utils
 * Ads Framework specific utils used by Admin
 *
 * @package Merix\LaraPanel\Core\Contracts
 */
interface Utils
{
    public function call($callable, $parameters);


}