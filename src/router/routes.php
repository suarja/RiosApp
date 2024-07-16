<?php



$router->get('/', base_path('/src/controllers/landing.php'));
$router->get('/players', base_path('/src/controllers/players.php'));
$router->get('/player', base_path('/src/controllers/player.php'));
$router->get('/player/store', base_path('/src/controllers/store-form.php'));
$router->post('/player/store', base_path('/src/controllers/store.php'));
$router->get('/players/create', base_path('/src/controllers/create-player.php'));
