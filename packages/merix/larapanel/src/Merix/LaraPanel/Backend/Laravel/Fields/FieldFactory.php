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
        $this->registerField('bool',        'Merix\LaraPanel\Backend\Laravel\Fields\BooleanField',  []);
        $this->registerField('number',      'Merix\LaraPanel\Backend\Laravel\Fields\NumberField',   []);

        $this->registerField('text',        'Merix\LaraPanel\Backend\Laravel\Fields\TextField',     []);
        $this->registerField('textarea',    'Merix\LaraPanel\Backend\Laravel\Fields\TextField',     ['editor' => 'textarea']);
        $this->registerField('wyswig',      'Merix\LaraPanel\Backend\Laravel\Fields\TextField',     ['editor' => 'wyswig']);
        $this->registerField('markdown',    'Merix\LaraPanel\Backend\Laravel\Fields\TextField',     ['editor' => 'markdown']);
        $this->registerField('hidden',      'Merix\LaraPanel\Backend\Laravel\Fields\TextField',     ['editor' => 'hidden']);
        $this->registerField('password',    'Merix\LaraPanel\Backend\Laravel\Fields\TextField',     ['editor' => 'password']);

        $this->registerField('file',        'Merix\LaraPanel\Backend\Laravel\Fields\FileField',     []);

        $this->registerField('datetime',    'Merix\LaraPanel\Backend\Laravel\Fields\DateTimeField', []);
        $this->registerField('date',        'Merix\LaraPanel\Backend\Laravel\Fields\DateTimeField', ['time' => false]);
        $this->registerField('time',        'Merix\LaraPanel\Backend\Laravel\Fields\DateTimeField', ['date' => false]);

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