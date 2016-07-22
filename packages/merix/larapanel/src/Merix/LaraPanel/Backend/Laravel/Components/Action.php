<?php

namespace Merix\LaraPanel\Backend\Laravel\Components;

use Merix\LaraPanel\Core\Contracts\Components\ActionManagement;
use Merix\LaraPanel\Core\Contracts\Modules\Config;
use Merix\LaraPanel\Core\Contracts\Components\Action as BaseAction;

class Action implements BaseAction, ActionManagement
{
    protected $laraPanel;

    protected $name;
    protected $owner; // Panel or Admin

    // Style
    protected $label;
    protected $tooltip;
    protected $icon;
    protected $class;

    // Functions
    protected $redirect; // Redirect instead of using ajax
    protected $path; // Custom path for this action

    // Permissions
    protected $visible;
    protected $allowed;

    // Handler
    protected $handler;

    // Action management
    protected $response = [
        'refresh'       => false,
        'redirect'      => false,
        'open-edit'     => false,
        'close-edit'    => false,
        'fill-fields'   => [],
        'errors'        => false,
        'messages'      => [],
        'popups'        => [],
    ];



    //------------------------------------------------------------------------------------------------------------------
    // Initialization

    public function __construct(
        $laraPanel,
        $owner,
        $name, $handler, // System handling
        $label, $class = '', $icon = null, $tooltip ='', // Visuals
        $redirect = false, $path = null, // Custom handling
        $visible = true, $allowed = true // Permissions
    )
    {
        $this->laraPanel = $laraPanel;
        $this->owner = $owner;

        $this->name = $name;
        $this->handler = $handler;

        $this->label = $label;
        $this->class = $class;
        $this->icon = $icon;
        $this->tooltip = $tooltip;

        $this->path = $path;
        $this->redirect = $redirect;

        $this->visible = $visible;
        $this->allowed = $allowed;
    }

    public function setPermissions($visible, $allowed)
    {
        $this->visible = $visible;
        $this->allowed = $allowed;
    }


    //------------------------------------------------------------------------------------------------------------------
    // Getters

    public function getName()
    {
        return $this->name;
    }

    public function getOwner()
    {
        return $this->owner;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getTooltip()
    {
        return $this->tooltip;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function getClass()
    {
        return $this->class;
    }

    public function getRedirect()
    {
        return $this->redirect;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getVisible()
    {
        return $this->visible;
    }

    public function getAllowed()
    {
        return $this->allowed;
    }

    public function getResponse()
    {
        return $this->response;
    }



    //------------------------------------------------------------------------------------------------------------------
    // Call the handler

    public function call($data)
    {
        $handler = $this->handler;
        if($handler instanceof \Closure)
        {
            //TODO: Exception handling
            return $handler($this->owner, $data, $this);
        }

        return null;
    }



    //------------------------------------------------------------------------------------------------------------------
    // Action management

    public function refresh()
    {
        $this->response['refresh'] = true;
    }

    public function redirect($path)
    {
        $this->response['redirect'] = $path;
    }

    public function openEdit($adminName, $id)
    {
        $this->response['open-edit'] = [
            'admin' => $adminName,
            'id' => $id,
        ];
    }

    public function closeEdit()
    {
        $this->response['close-edit'] = true;
    }

    public function fillField($field, $value)
    {
        $this->response['fill-fields'][$field] = $value;
    }

    public function fillFields($fields = null)
    {
        //TODO: Merge with existent
        $this->response['fill-fields'] = $fields;
    }

    public function error($field, $message)
    {
        if(!is_array($this->response['errors']))
        {
            $this->response['errors'] = [];
        }

        $this->response['errors'][$field] = $message;
    }

    public function errors($fields)
    {
        //TODO: Merge with existent
        $this->response['errors'] = $fields;
    }

    public function message($label, $message, $class = '', $time = 2000)
    {
        $this->response['messages'][] = [
            'class' => $class,
            'label' => $label,
            'message' => $message,
            'time' => $time,
        ];
    }

    public function popup($label, $message, $class = '', $button = 'OK')
    {
        $this->response['popups'][] = [
            'class' => $class,
            'label' => $label,
            'message' => $message,
            'button' => $button,
        ];
    }

    public function customResponse($type, $value)
    {
        $this->response[$type] = $value;
    }



    //------------------------------------------------------------------------------------------------------------------
    // Serialization

    public function toArray()
    {
        return [
            'name'      => $this->getName(),
            'label'     => $this->getLabel(),
            'icon'      => $this->getIcon(),
            'tooltip'   => $this->getTooltip(),
            'visible'   => $this->getVisible(),
            'allowed'   => $this->getAllowed(),
        ];
    }

}