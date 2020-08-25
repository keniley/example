<?php

return [
    
    'default' => 'default',

    'channels' => [
        'default' => [
            'driver' => 'smtp',
            'host' => 'smtp.seznam.cz',
            'port' => 465,
            'username' => 'petr.jelinek@larapp.cz',
            'password' => '51425142xX',
            'encryption' => 'ssl',
            'from' => [
                'address' => 'petr.jelinek@larapp.cz',
                'name' => 'Petr Jelínek',
            ],
        ]
    ]
    
];