<?php

namespace Merix\LaraPanel\Backend\Laravel\Fields;


use Merix\LaraPanel\Backend\Laravel\Utils\Convert;

class TextField extends Field
{
    protected $editor;

    protected function init()
    {
        parent::init();
        $this->editor = $this->getConfigValue('editor');
    }

    protected function getDefaultParameters()
    {
        return array_merge(parent::getDefaultParameters(), [
            'editor' => 'input',
        ]);
    }

    public function getType()
    {
        return 'text';
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