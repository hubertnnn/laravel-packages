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

    // Alternative way (instead of admins)
    'menu' => [
        [
            'name' => 'menu name',
            'admin' => '{admin}',

            'label' => 'Label that will show on menu',
            'class' => 'custom classes',

            'parent' => 'parent menu name',
            'children' => 'alternative to parent | array of menu items',
        ],
        'menu-name' => [
            '...' => '...',
        ],
        [
            'name' => 'menu-name',
            '...' => '...',
        ],
    ],

    'default-admin' => '{admin}',

    'actions' => [
        'logout' => 'true|false|null', //NULL = not visible, FALSE = disabled, TRUE = enabled
        'homepage' => 'true',
    ],

    'custom-actions' => [
        [
            "name" => "{action}",
            "label" => "Logout | translates",
            "class" => "Class for action button",
            "icon" => "glyphicon glyphicon-off",
            "tooltip" => "Text shown on hover",
            "visible" => 'true|false|function()',
            "allowed" => 'true|false|function()',
            "handle"  => 'function($owner, $data, $actionManagement)',

        ],
    ],

];