<?php


return [
    'route' => 'admin2',

    'panels' => [
        'admin',
        'user',
    ],

    'test1' => 'aaa',
    'test2' => function(){
        return 'bbb';
    },
    'test3' => function($in){
        return 'ccc'.$in;
    },

];