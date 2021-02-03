<?php

return [
    // members.ip, array
    'default' => env('GUEST_RESOLVER', 'members.ip'),

    'resolvers' => [
        'members.ip' => [
            'driver' => 'members.ip',
            'url' => env('GUEST_RESOLVER_MEMBER_URL', 'http://ip-api.com/json/')
        ],
        'array' => [
            'driver' => 'array'
        ]
    ]
];
