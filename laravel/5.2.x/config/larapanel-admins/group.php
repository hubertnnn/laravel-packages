<?php


return [
    'name' => 'Groups',
    'type' => 'entity',

    // Entity / single / table
    'entity' => 'App\User',

    // Entity
    'width' => '800',


    'actions' => [
        'reset' => true,
    ],

    'custom-actions' => [
        [
            "name" => "reset",
            "Label" => "Reset password",
            "Icon" => "glyphicon glyphicon-lock",
            "tooltip" => "This will send a password resetting email",
            "visible" => true,
            "allowed" => true,
            "handle"  => function($admin, $data, $action){
                /** @var \Merix\LaraPanel\Core\Contracts\ActionManagement $action */
                $action->message('success', 'test was successful');
                $action->closeEdit();
                $action->fillField('aaa', 'bbb');
                $action->refresh();
            },

        ],
    ],



    // Filters

    'filters' => [
        [
            'name' => 'name',
            'field' => 'name',
            'type' => 'text',

            'default' => '',
            'label' => 'User Name',
            'tooltip' => 'User Name',
            'placeholder' => 'User Name',

            'enabled' => true,
        ],
        [
            'name' => 'email',
            'field' => 'email',
            'type' => 'text',

            'default' => '',
            'label' => 'Email',
            'tooltip' => 'Email',
            'placeholder' => 'Email',

            'enabled' => true,
        ],
        [
            'name' => 'any',
            'type' => 'text',

            'default' => '',
            'label' => 'Email',
            'tooltip' => 'Email',
            'placeholder' => 'Email',

            'enabled' => true,
            'handle' => function($query, $value, $field){
                $query->where(function ($query) use($value){
                    $query
                        ->orWhere('name', 'like', '%'.$value.'%')
                        ->orWhere('email', 'like', '%'.$value.'%')
                    ;
                });
            },
        ],
    ],



    // Edit window
    'fields' => [
        [
            'name' => 'name',
            'field' => 'name',
            'type' => 'text',

            'default' => '',
            'label' => 'User Name',
            'tooltip' => 'User Name',
            'placeholder' => 'User Name',

            'enabled' => true,
        ],
        [
            'name' => 'email',
            'field' => 'email',
            'type' => 'text',

            'default' => '',
            'label' => 'Email',
            'tooltip' => 'Email',
            'placeholder' => 'Email',

            'enabled' => true,
        ],
    ],

];