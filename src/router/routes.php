<?php

$router->get('/', base_path('/src/controllers/landing.php'));
$router->get('/players', base_path('/src/controllers/players/index.php'));
$router->get('/player', base_path('/src/controllers/players/show.php'));
$router->get('/player/store', base_path('/src/controllers/players/create.php'));
$router->post('/player/store', base_path('/src/controllers/players/store.php'));


$router->get('/register', base_path('/src/controllers/registration/index.php'));
$router->post('/register', base_path('/src/controllers/registration/store.php'));
$router->get('/login', base_path('/src/controllers/registration/login.php'));
