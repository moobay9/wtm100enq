<?php

return [
    'default' => [
        'type' => 'mysqli',
        'connection'  => [
            'username'   => 'wtm100',
            'password'   => 'wtm100',
            'port'       => '3306',
            'hostname'   => 'localhost',
            'database'   => 'wtm100',
            'persistent' => false,
            'compress'   => true,
        ],
        'charset'      => 'utf8',
        'enable_cache' => true,
        'profiling'    => true,
        'table_prefix' => 'wtm_',
    ],
];
