<?php


return [
    'type' => 'cms|panel',
    'theme' => 'default | slate | ...',

    'name' => 'Panel name used in left corner and in title bar',
    'icon' => 'Panel icon used in left corner and as favicon',
    'favicon' => 'overrides icon to become favicon',

    'admins' => [
        'Menu1' => [
            'Submenu1' => [
                'Users' => '{admin}',
            ],
        ],
        'Not users' => '{admin}',
    ],

    'default-admin' => '{admin}',

    'actions' => [
        'logout' => 'true',
        'homepage' => 'true',
    ],

    'custom-actions' => [
        [
            "name" => "{action}",
            "Label" => "Logout | translates",
            "Icon" => "glyphicon glyphicon-off",
            "tooltip" => "Text shown on hover",
            "visible" => 'true|false|function()',
            "allowed" => 'true|false|function()',
            "handle"  => 'function()',

        ],
    ],

];