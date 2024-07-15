<?php
require base_path(
    "/data-classes/index.php"
);

$playerOnePath =
base_path(
    "/src/data/player-1.json"
);
$playerOneJsonString = file_get_contents($playerOnePath);
$playerOne = Player::fromJSON($playerOneJsonString);
