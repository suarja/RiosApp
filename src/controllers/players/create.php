
<?php

$isLogged = isLogged();
$heading = "Create Player";
$errors = [];
require view('players/player-form', compact('heading', 'errors', 'isLogged'));
