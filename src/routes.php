<?php
// Routes

$app->get('/', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    require  "../class/app.inc.php";
    return $this->renderer->render($response, 'home.php', $args);
});

//Vista incidencias
$app->get('/incidencias_add', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    require  "../class/app.inc.php";
    return $this->renderer->render($response, 'incidencias/new.php', $args);
});
