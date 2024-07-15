<?php
require base_path('/src/data/player-1.php');
$heading = 'Players';

use Core\Database;

require base_path("/config.php");
require base_path("/src/data/seasons-list.php");
require base_path('/src/core/Database.php');
require base_path('/data-classes/PlayerWithStats.php');

$db = new Database($DB_CONFIG);
$seasonId;
$PUBG_API_KEY;
// Get all players from the database
$players = $db->getPlayers();
$teamPlayers = [];
foreach ($players as $player) {
    $player = Player::fromDB($player);
    $playerSeasonStats = getPlayerSeasonStats($player, $seasonId, $PUBG_API_KEY);
    $teamPlayers[] = new PlayerWithStats($player, $playerSeasonStats);
}

require view('players', compact('heading', 'teamPlayers'));

