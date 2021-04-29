<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails' => true,

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        'db' => [
	        'driver' => 'mysql',
	        'host' => '172.17.0.1',
            'port' => '3306',
	        'database' => 'donations',
	        'username' => 'root',
	        'password' => 'root',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
        ],
    ],
];
