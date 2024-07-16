<?php


$router->get('/', base_path('/src/controllers/landing.php'));
$router->get('/players', base_path('/src/controllers/players/index.php'));
$router->get('/player', base_path('/src/controllers/players/show.php'));
$router->get('/player/store', base_path('/src/controllers/players/create.php'));
$router->post('/player/store', base_path('/src/controllers/players/store.php'));
