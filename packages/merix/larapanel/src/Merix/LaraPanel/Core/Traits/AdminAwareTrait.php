<?php

namespace Merix\LaraPanel\Core\Traits;



use Merix\LaraPanel\Core\Contracts\Modules\Admin;

trait AdminAwareTrait
{
    protected $admin;

    /**
     * @return Admin
     */
    public function getAdmin()
    {
        return $this->admin;
    }

}