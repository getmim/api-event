<?php

return [
    '__name' => 'api-event',
    '__version' => '0.0.1',
    '__git' => 'git@github.com:getmim/api-event.git',
    '__license' => 'MIT',
    '__author' => [
        'name' => 'Iqbal Fauzi',
        'email' => 'iqbalfawz@gmail.com',
        'website' => 'http://iqbalfn.com/'
    ],
    '__files' => [
        'modules/api-event' => ['install','update','remove']
    ],
    '__dependencies' => [
        'required' => [
            [
                'venue' => NULL
            ],
            [
                'lib-app' => NULL
            ],
            [
                'api' => NULL
            ]
        ],
        'optional' => []
    ],
    'autoload' => [
        'classes' => [
            'ApiEvent\\Controller' => [
                'type' => 'file',
                'base' => 'modules/api-event/controller'
            ]
        ],
        'files' => []
    ],
    'routes' => [
        'api' => [
            'apiEventIndex' => [
                'path' => [
                    'value' => '/event/object'
                ],
                'handler' => 'ApiEvent\\Controller\\Event::index',
                'method' => 'GET'
            ],
            'apiEventSingle' => [
                'path' => [
                    'value' => '/event/object/(:identity)',
                    'params' => [
                        'identity' => 'any'
                    ]
                ],
                'handler' => 'ApiEvent\\Controller\\Event::single',
                'method' => 'GET'
            ]
        ]
    ]
];