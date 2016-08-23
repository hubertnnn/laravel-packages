<?php

namespace Merix\LaraPanel\Backend\Laravel\Fields;

use Merix\LaraPanel\Backend\Laravel\Modules\Edit;
use Merix\LaraPanel\Core\Contracts\Components\Field as BaseField;
use Merix\LaraPanel\Core\Contracts\Modules\Config;
use Merix\LaraPanel\Core\Contracts\Modules\LaraPanel;
use Merix\LaraPanel\Core\Traits\AdminAwareTrait;
use Merix\LaraPanel\Core\Traits\EditAwareTrait;
use Merix\LaraPanel\Core\Traits\LaraPanelAwareTrait;
use Merix\LaraPanel\Core\Traits\OwnerAwareTrait;
use Merix\LaraPanel\Core\Traits\PanelAwareTrait;

abstract class Field implements BaseField
{
    use OwnerAwareTrait;
    use LaraPanelAwareTrait;
    use PanelAwareTrait;
    use AdminAwareTrait;
    use EditAwareTrait;

    protected $config;
    protected $parameters;

    protected $name;
    protected $field;
    protected $label;
    protected $tab;
    protected $section;
    protected $readOnly;
    protected $depends;
    protected $validator;


    /**
     * @param $owner Edit
     * @param $config Config
     * @param $parameters
     */
    public function __construct($owner, $config, $parameters)
    {
        $this->owner = $owner;
        $this->edit = $owner;
        $this->admin = $owner->getAdmin();
        $this->panel = $owner->getPanel();
        $this->laraPanel = $owner->getLaraPanel();

        $this->config = $config;
        $this->parameters = array_merge($this->getDefaultParameters(), $parameters);

        $this->init();
    }

    protected function init()
    {
        $this->name = $this->getConfigValue('name');
        $this->field = $this->getConfigValue('field', $this->name);
        $this->label = $this->getConfigValue('label');
        $this->tab = $this->getConfigValue('tab');
        $this->section = $this->getConfigValue('section');
        $this->readOnly = $this->getConfigValue('readonly');
        $this->depends = $this->getConfigValue('depends');
        $this->validator = $this->getConfigValue('validator');
    }

    protected function getDefaultParameters()
    {
        return [
            'tab' => 'default',
            'section' => 'default',
        ];
    }

    // -----------------------------------------------------------------------------------------------------------------
    // Config handling

    public function getConfig()
    {
        return $this->config;
    }

    protected function getConfigValue($key, $default = null)
    {
        $default = isset($this->parameters[$key]) ? $this->parameters[$key] : $default;
        $value = $this->getConfig()->getValue($key, $this, $default);
        return $value;
    }


    // -----------------------------------------------------------------------------------------------------------------
    // Getters for simple fields

    // Must be implemented by instance
    public abstract function getType();

    public function getName()
    {
        return $this->name;
    }

    public function getField()
    {
        return $this->field;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getTab()
    {
        return $this->tab;
    }

    public function getSection()
    {
        return $this->section;
    }

    public function getReadOnly()
    {
        return $this->readOnly;
    }

    public function getDepends()
    {
        return $this->depends;
    }

    public function getValidator()
    {
        return $this->validator;
    }


    // -----------------------------------------------------------------------------------------------------------------
    // Getters more advanced values

    public function getStructure()
    {
        return [
            'name' => $this->getName(),
//            'field' => $this->getField(), // This is only used by backend
            'label' => $this->getLabel(),

            'tab' => $this->getTab(),
            'section' => $this->getSection(),

            'type' => $this->getType(),
        ];
    }

    public function getData()
    {
        return [
            'name' => $this->getName(),
            'value' => $this->read(),
        ];
    }

    public function getObject()
    {
        return $this->getEdit()->getObject();
    }


    // -----------------------------------------------------------------------------------------------------------------
    // Field logic

    public function read()
    {
        $function = $this->getConfig()->getClosure('read');
        if($function !== null)
            return $function($this);

        return $this->doRead($this);
    }

    public function write($value)
    {
        $function = $this->getConfig()->getClosure('write');
        if($function !== null)
            return $function($this);

        return $this->doWrite($this, $value);
    }

    public function search($data)
    {
        $function = $this->getConfig()->getClosure('search');
        if($function !== null)
            return $function($this);

        return $this->doSearch($this, $data);
    }

    protected abstract function doRead($field);

    protected abstract function doWrite($field, $value);

    protected abstract function doSearch($field, $data);

    
    public abstract function serialize($data);

    public abstract function deserialize($data);

}