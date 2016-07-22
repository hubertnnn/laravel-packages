<?php

namespace Merix\LaraPanel\Backend\Laravel\Fields;

use Merix\LaraPanel\Core\Contracts\FieldFactory as BaseFieldFactory;
use Merix\LaraPanel\Core\Contracts\LaraPanel;

class FieldFactory implements BaseFieldFactory
{
    protected $laraPanel;
    protected $fields;

    public function __construct(LaraPanel $laraPanel)
    {
        $this->laraPanel = $laraPanel;
        $this->init();
    }


    protected function init()
    {
        $this->registerField('text', 'Merix\LaraPanel\Backend\Laravel\Fields\TextField', []);

    }

    public function registerField($type, $class, $defaultParameters = [])
    {
        $this->fields[$type] = [
            'class' => $class,
            'parameters' => $defaultParameters,
        ];
    }

    public function createField($type, $data, $parameters = [])
    {
        if(isset($this->fields[$type]))
        {
            $type = $this->fields[$type]['class'];
            $parameters = array_merge($this->fields[$type]['parameters'], $parameters);
        }

        if(!class_exists($type))
        {
            return null;
        }

        $instance = app()->make($type, ['parameters' => $parameters]);

        return $instance;
    }


}