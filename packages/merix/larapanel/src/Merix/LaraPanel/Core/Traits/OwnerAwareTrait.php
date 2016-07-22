<?php

namespace Merix\LaraPanel\Core\Traits;



trait OwnerAwareTrait
{
    protected $owner;

    /**
     * @return mixed
     */
    public function getOwner()
    {
        return $this->owner;
    }

}