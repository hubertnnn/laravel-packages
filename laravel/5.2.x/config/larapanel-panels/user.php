<?php


return [
    'type' => 'cms',
    'theme' => 'slate',

    'name' => 'User',
    'icon' => 'xxx.png',
    'favicon' => 'yyy.png',

    'menu' => [
        [
            'label' => 'Label 1',
            'class' => 'class-1',
            'admin' => 'admin1',
        ],
        [
            'label' => 'Label 2',
            'class' => 'class-2',
            'menu' => [
                [
                    'label' => 'Label 3',
                    'class' => 'class-3',
                    'admin' => 'admin3',
                ],
                [
                    'label' => 'Label 4',
                    'class' => 'class-4',
                    'admin' => 'admin4',
                ],
            ],
        ],
    ],

    'default-admin' => 'test1',

    'actions' => [
        'logout' => true,
        'homepage' => true,
        'test' => true,
    ],

    'custom-actions' => [
        [
            "name" => "test",
            "Label" => "Test Me",
            "Icon" => "glyphicon glyphicon-star",
            "tooltip" => "You should run a test now",
            "visible" => true,
            "allowed" => true,
            "handle"  => function($panel, $data, $action){
                $action->message('success', 'test was successful');
            },

        ],
    ],

];