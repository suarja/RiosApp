<?php
require base_path('/src/data/player-1.php');
$heading = 'Players';

require view('players', compact('heading'));
