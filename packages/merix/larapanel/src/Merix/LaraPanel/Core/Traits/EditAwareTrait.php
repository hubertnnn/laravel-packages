<?php

namespace Merix\LaraPanel\Core\Traits;



use Merix\LaraPanel\Core\Contracts\Modules\Edit;

trait EditAwareTrait
{
    protected $edit;

    /**
     * @return Edit
     */
    public function getEdit()
    {
        return $this->edit;
    }

}