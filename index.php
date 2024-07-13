<?php
require "./data/player-1.php";
require './src/functions.php';
$heading = "RiosApp";
$rios = $playerOne;
$riosName = $rios->attributes->name;
// dd($rios->attributes->name);




require './views/index.view.php';
