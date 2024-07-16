<?php
require base_path('/src/data/player-1.php');
$heading = 'Players';


require base_path("/config.php");
require base_path("/src/data/seasons-list.php");
require base_path('/src/core/Database.php');
require base_path('/data-classes/PlayerWithStats.php');

$db = new Database($DB_CONFIG);
$seasonId;
$PUBG_API_KEY;
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
