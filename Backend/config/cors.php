<?php

return [

    'paths' => ['api/*', 'auth/*'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        'http://localhost:9000',
        'http://192.168.1.106:9000',
        'http://192.168.98.125:9000'
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];