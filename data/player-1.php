<?php
require "./data-classes/index.php";

$playerOnePath = "./data/player-1.json";
$playerOneJsonString = file_get_contents($playerOnePath);
$playerOne = Player::fromJSON($playerOneJsonString);

