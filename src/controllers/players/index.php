<?php
require_once base_path('/src/data/player-1.php');
$heading = 'Players';
$isLogged = isLogged();

require_once base_path("/src/data/seasons-list.php");
require_once base_path('/data-classes/PlayerWithStats.php');

require_once base_path("/src/core/App.php");
$db = App::resolve('db');
$PUBG_API_KEY = App::resolve('PUBG_API_KEY');


// Get all players from the database
$players = $db->getPlayers();

// Si aucun joueur n'est enregistré, définir un tableau vide
$teamPlayers = [];

if (!empty($players)) {
    // Map the players to an array of their account id 
    $playersAccountsIds = array_map(function ($player) {
        return $player['id'];
    }, $players);
    
    // Utiliser le seasonId depuis seasons-list.php
    $playerSeasonStats = getPlayerListSeasonStats($playersAccountsIds, $seasonId, $PUBG_API_KEY);
    
    // Vérifier si on a des stats
    if ($playerSeasonStats === null) {
        $playerSeasonStats = [];
    }
    
    foreach ($players as  $player) {
        $player = Player::fromDB($player);
        $stats = null;

        foreach ($playerSeasonStats as $playerSeasonStat) {
            if ($playerSeasonStat->playerId() == $player->id) {
                $stats = $playerSeasonStat;
                break;
            }
        }
        $teamPlayers[] = new PlayerWithStats($player, $stats);
    }
}

require view('players/players', compact('heading', 'teamPlayers', 'isLogged'));
