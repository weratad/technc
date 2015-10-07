<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'view' => [
            'renderers' => [
                'haml' => [
                    'class' => 'mervick\mthaml\HamlViewRenderer',
                    'filters' => [
                        'coffee' => 'CoffeeScript',
                    ],
                ],
            ],
        ],
    ],
];
