<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'models_paths' => [
        base_path('app'),
    ],

    'factories_path' => base_path('tests/Factories'),

    'factories_namespace' => 'Tests\Factories',

    'vanilla_factories_path' => database_path('factories'),
];
