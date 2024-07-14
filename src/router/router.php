<?php

$routes = [
    '/' => './src/controllers/landing.php',
    '/players' => './src/controllers/players.php',
    '/players/create' => './src/controllers/create-player.php',
];

function routeToController($routes)
{
    $uri = $_SERVER['REQUEST_URI'];
    // Normalize the URI to ensure routing works as expected
    $uri = parse_url($uri, PHP_URL_PATH);

    if (array_key_exists($uri, $routes)) {
        require $routes[$uri];
    } else {
        http_response_code(404);
        echo "404 Not Found";
    }
}

// Call the routing function
routeToController($routes);
