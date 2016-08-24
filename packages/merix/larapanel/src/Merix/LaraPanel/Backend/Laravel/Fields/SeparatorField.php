<?php

namespace Merix\LaraPanel\Backend\Laravel\Fields;


use Merix\LaraPanel\Backend\Laravel\Utils\Convert;

class SeparatorField extends Field
{

    public function getType()
    {
        return 'separator';
    }

    protected function doGet()
    {
        // This field does not modify any data
    }

    protected function doSet($value)
    {
        // This field does not modify any data
    }

    public function serialize($data)
    {
        // This field does not modify any data
    }

    public function deserialize($data)
    {
        // This field does not modify any data
    }

    public function getData()
    {
        return null;
    }


}