<?php

namespace Merix\LaraPanel\Backend\Laravel\Fields;


use Merix\LaraPanel\Backend\Laravel\Utils\Convert;

class BooleanField extends Field
{
    public function getType()
    {
        return 'boolean';
    }

    protected function doGet()
    {
        return Convert::toBool($this->getObject()->{$this->getField()});
    }

    protected function doSet($value)
    {
        $this->getObject()->{$this->getField()} = Convert::toBool($value);
    }

}