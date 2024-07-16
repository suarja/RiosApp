<?php

$router->get('/', base_path('/src/controllers/landing.php'));
$router->get('/players', base_path('/src/controllers/players/index.php'))->only('auth');
$router->get('/player', base_path('/src/controllers/players/show.php'))->only('auth');
$router->get('/player/store', base_path('/src/controllers/players/create.php'))->only('auth');
$router->post('/player/store', base_path('/src/controllers/players/store.php'))->only('auth');


$router->get('/register', base_path('/src/controllers/registration/index.php'));
$router->post('/register', base_path('/src/controllers/registration/store.php'));
$router->get('/login', base_path('/src/controllers/registration/login.php'));
$router->post('/login', base_path('/src/controllers/registration/auth.php'));
