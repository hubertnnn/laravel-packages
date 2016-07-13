<?php


return [
    'type' => 'panel',
    'theme' => 'default',

    'name' => 'Admin',
    'icon' => 'aaa.png',
    'favicon' => 'bbb.png',

    'admins' => [
        'Test 1' => 'test1',
        'Test 2' => 'test2',
        'Menu 1' => [
            'Test 3' => 'test3',
            'Test 4' => 'test4',
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