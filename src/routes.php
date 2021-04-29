<?php

// Routes

$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->get('/api/enums/donations', function ($request, $response, $args) {
    return $response->withJson(array('5', '10', '20', '50', '100'));
});


$app->get('/api/donations', \App\Controllers\HomeController::class);

$app->post('/auth/register', \App\Controllers\AuthController::class.':register')->setName('auth.register');


// GET application information
$app->get('/api/info', function () use ($app) {
    echo '<h1>'.json_decode(file_get_contents(__DIR__ . '/../composer.json'))->name.'</h1>';
    echo '<p>'.json_decode(file_get_contents(__DIR__ . '/../composer.json'))->description.'</p>';
});
