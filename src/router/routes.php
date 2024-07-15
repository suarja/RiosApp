<?php

use  Router\Router;

$router = new Router();
$router->get('/', base_path('/src/controllers/landing.php'));
$router->get('/players', base_path('/src/controllers/players.php'));
$router->get('/player', base_path('/src/controllers/player.php'));
$router->get('/players/create', base_path('/src/controllers/create-player.php'));

