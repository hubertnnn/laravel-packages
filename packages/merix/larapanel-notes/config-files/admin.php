<?php


return [
    'name' => 'Admin name used in left corner',
    'type' => 'entity | global | single | table | custom',

    // Entity / single / table
    'entity' => 'App\Model\MyEntity',
    'query' => 'function() that should return query builder or array (array cannot be filtered)',

    // Entity
    'width' => 'width of edit screen',

    // Custom
    'view' => 'where to load custom content from',


    'actions' => [
        'new' => 'true | function()',
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



    // Data grid

    'columns' => [
        [
            'name' => 'aaa',
            'type' => 'bbb',

            'label' => 'column label | defaults to name',
            'field' => 'used field | defaults to name',

            'output' => 'function($field)',

            '...' => '...',
        ],
    ],


    // Filters

    'filters' => [
        [
            'name' => 'filter-name',
            'field' => 'used field | defaults to name',
            'type' => 'filter-type',

            'default' => 'default value for a filter',
            'label' => 'filter label',
            'tooltip' => 'filter tooltip',
            'placeholder' => 'filter placeholder',

            'enabled' => 'true|false|function()',
            'handle' => 'function($field, $value, $query) returns $query',
        ],
    ],



    // Edit window

    'tabs' => [
        'tab1-name' => [
            'label' => 'tab1-label',
            'class' => 'tab1-classes',
        ],
    ],

    'sections' =>[
        'section1-name' => [
            'label' => 'section1-label',
            'class' => 'section1-classes',
            'tab' => 'tab1-name',
            'parent' => '',
        ],
        'section2-name' => [
            'label' => 'section2-label',
            'class' => 'section2-classes',
            'tab' => '',
            'parent' => 'section1-name', //parent overrides tab
        ],
    ],

    'fields' => [
        [

        ],
    ],

];