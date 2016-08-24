<?php

namespace Merix\LaraPanel\Backend\Laravel\Fields;


use Merix\LaraPanel\Backend\Laravel\Utils\Convert;

class NumberField extends Field
{
    public function getType()
    {
        return 'number';
    }

    protected function doGet()
    {
        return Convert::toInteger($this->getObject()->{$this->getField()});
    }

    protected function doSet($value)
    {
        $this->getObject()->{$this->getField()} = Convert::toInteger($value);
    }

}