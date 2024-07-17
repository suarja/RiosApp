<?php
require_once base_path('/src/data/player-1.php');
$heading = 'Players';
$isLogged = isLogged();

require_once base_path("/src/data/seasons-list.php");
require_once base_path('/data-classes/PlayerWithStats.php');

require_once base_path("/src/core/App.php");
$db = App::resolve('db');
$PUBG_API_KEY = App::resolve('PUBG_API_KEY');


$seasonId;
// Get all players from the database
$players = $db->getPlayers();
// Map the players to an arrray of their account id 
$playersAccountsIds = array_map(function ($player) {
    return $player['id'];
}, $players);
$playerSeasonStats = getPlayerListSeasonStats($playersAccountsIds, $seasonId, $PUBG_API_KEY);
$teamPlayers = [];
foreach ($players as  $player) {
    $player = Player::fromDB($player);
    $stats;

    foreach ($playerSeasonStats as $playerSeasonStat) {
        if ($playerSeasonStat->playerId() == $player->id) {
            $stats = $playerSeasonStat;
            break;
        }
    }
    $teamPlayers[] = new PlayerWithStats($player, $stats);
}

require view('players/players', compact('heading', 'teamPlayers'));
