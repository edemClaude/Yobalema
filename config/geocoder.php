<?php

return [
    'providers' => [
        'nominatim' => [
            'adapter' => 'http',
            'endpoint' => 'https://nominatim.openstreetmap.org/search',
            'user_agent' => 'laravel-geocoder',
        ],
    ],
];
