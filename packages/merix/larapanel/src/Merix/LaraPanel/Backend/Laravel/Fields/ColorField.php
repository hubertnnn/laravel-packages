<?php

namespace Merix\LaraPanel\Backend\Laravel\Fields;


use Merix\LaraPanel\Backend\Laravel\Utils\Convert;

class ColorField extends Field
{
    public function getType()
    {
        return 'color';
    }

    protected function doGet()
    {
        return Convert::toString($this->getObject()->{$this->getField()});
    }

    protected function doSet($value)
    {
        $this->getObject()->{$this->getField()} = Convert::toString($value);
    }

}