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
    foreach ($players as $player) {
        $playerObj = Player::fromDB($player);
        
        // Récupérer les lifetime stats pour chaque joueur
        $lifetimeStats = getPlayerLifetimeStats($playerObj->id, $PUBG_API_KEY);
        $stats = null;
        
        if ($lifetimeStats) {
            // Créer un objet stats simple pour compatibilité avec PlayerWithStats
            $totalStats = calculateTotalStats($lifetimeStats);
            $stats = (object) [
                'kills' => $totalStats['kills'],
                'wins' => $totalStats['wins'],
                'losses' => $totalStats['losses'],
                'roundsPlayed' => $totalStats['roundsPlayed'],
                'kd' => $totalStats['roundsPlayed'] > 0 ? $totalStats['kills'] / max($totalStats['losses'], 1) : 0,
                'assists' => 0, // Pas disponible dans lifetime stats
                'maxKillStreaks' => 0, // Pas disponible dans lifetime stats
                'longestKill' => $totalStats['longestKill'],
                'headshotKills' => $totalStats['headshotKills'],
                'solo' => $lifetimeStats['solo'] ?? [],
                'duo' => $lifetimeStats['duo'] ?? [],
                'squad' => $lifetimeStats['squad'] ?? []
            ];
        } else {
            // Debug: Afficher pourquoi les stats ne sont pas disponibles
            error_log("Lifetime stats non disponibles pour le joueur: " . $playerObj->attributes->name . " (ID: " . $playerObj->id . ")");
        }
        
        $teamPlayers[] = new PlayerWithStats($playerObj, $stats);
    }
}

require view('players/players', compact('heading', 'teamPlayers', 'isLogged'));
