<?php
// DIC configuration

$container = $app->getContainer();

$container['upload_directory'] = __DIR__ . '/uploads';

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// Service factory for the ORM
$container['db'] = function ($container) {
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($container['settings']['db']);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], Monolog\Logger::DEBUG));
    return $logger;
};


// Controller Registration
$container['HomeController'] = function ($c) {
    $logger = $c->get('logger');
    $table = $c->get('db')->table('donations');
    return new \App\Controllers\HomeController();
};