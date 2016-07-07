<?php

namespace Merix\LaraPanel\Core\Components;



use Merix\LaraPanel\Core\Contracts\ActionManagement;

class Action implements ActionManagement
{
    public $laraPanel;
    public $owner; // Panel or Admin

    public $name;
    public $handler;

    public $label;
    public $class;
    public $icon;
    public $tooltip;

    public $path; // Custom path for this action
    public $redirect; // Redirect instead of using ajax

    public $visible;
    public $allowed;


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

    public function call($data)
    {
        if($this->handler instanceof \Closure)
        {
            return $this->handler($this->owner, $data, $this);
        }

        return null;
    }

    public function toArray()
    {
        return $this->response;
    }







    //------------------------------------------------------------------------------------------------------------------
    // Action management

    private $response = [
        'refresh'       => false,
        'redirect'      => false,
        'open-edit'     => false,
        'close-edit'    => false,
        'fill-fields'   => [],
        'errors'        => false,
        'messages'      => [],
        'popups'        => [],
    ];


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


}

