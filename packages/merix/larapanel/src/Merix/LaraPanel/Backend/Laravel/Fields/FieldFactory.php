<?php

namespace Merix\LaraPanel\Backend\Laravel\Fields;

use Merix\LaraPanel\Core\Contracts\Factories\FieldFactory as BaseFieldFactory;
use Merix\LaraPanel\Core\Contracts\Modules\LaraPanel;

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
        $this->registerField('file', 'Merix\LaraPanel\Backend\Laravel\Fields\FileField', []);

    }

    public function registerField($type, $class, $defaultParameters = [])
    {
        $this->fields[$type] = [
            'class' => $class,
            'parameters' => $defaultParameters,
        ];
    }

    public function createField($owner, $type, $config, $parameters = [])
    {
        if(isset($this->fields[$type]))
        {
            $fieldClass = $this->fields[$type]['class'];
            $parameters = array_merge($this->fields[$type]['parameters'], $parameters);
        }
        else
        {
            $fieldClass = $type;
        }

        if(!class_exists($fieldClass))
        {
            return null;
        }

        $instance = app()->make($fieldClass, ['owner' => $owner, 'config' => $config, 'parameters' => $parameters]);

        return $instance;
    }


}