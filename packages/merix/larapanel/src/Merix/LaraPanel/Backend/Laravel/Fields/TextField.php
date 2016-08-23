<?php

namespace Merix\LaraPanel\Backend\Laravel\Fields;


class TextField extends Field
{
    public function getType()
    {
        return 'text';
    }

    /**
     * @param $field Field
     * @return string
     */
    protected function doRead($field)
    {
        $value = $this->getObject()->{$this->getField()};

        if(is_string($value))
            return $value;

        if(is_object($value) && method_exists($value, 'toString'))
            return $value->toString();

        if(is_object($value) && method_exists($value, '__toString'))
            return $value->__toString();

        if(settype($value, 'string'))
            return $value;

        return ''; // There must be a string, not null
    }

    protected function doWrite($field, $value)
    {
        $this->getObject()->{$this->getField()} = $value;
    }

    protected function doSearch($field, $data)
    {
        // TODO: Implement doSearch() method.
    }


    public function serialize($data)
    {
        return ['value' => $data];
    }

    public function deserialize($data)
    {
        if(!isset($data['value']))
            return '';

        return $data['value'];
    }
}