<?php

namespace Merix\LaraPanel;


class Admin
{
    public function getName()
    {
        return 'Admin';
    }

    public function getMenu()
    {
//        return [
//            'Users' => [
//                'User' => 'User',
//                'Group' => 'Group',
//            ]
//        ];

        return [
            'Users' => 'Users',
            'Groups' => 'Groups',
            'Subs' => [
                'Sub1' => 'Sub1',
                'Sub2' => 'Sub2',
            ],
            'SuperSubs' => [
                'S1' =>[
                    'S2' => [
                        'S3' => 'S4'
                    ]
                ]
            ]
        ];
    }

}