<?php

$isLogged = isLogged();
$heading = "Create Player";

// Load dependencies
require_once base_path('/data-classes/index.php');
require_once base_path("/src/core/App.php");

$db = App::resolve('db');
$PUBG_API_KEY = App::resolve('PUBG_API_KEY');

$errors = [];
$playerName = $_POST['playerName'];
// Check if the player name is empty
if (empty($playerName)) {
    $errors[] = "Veuillez entrer un nom de joueur";
    require view('players/player-form', compact('heading', 'errors', 'isLogged'));
    exit;
}

// check in the database if the player exists
$isPlayerInDatabase = $db->isPlayerInDatabaseFromName($playerName);
if ($isPlayerInDatabase) {
    $errors[] = "Ce joueur est déjà dans votre équipe";
    require view('players/player-form', compact('heading', 'errors', 'isLogged'));
    exit;
} else {
    $player = getPlayer($playerName, $PUBG_API_KEY);
    if (!$player) {
        $errors[] = "Joueur '$playerName' introuvable sur PUBG Xbox. Vérifiez l'orthographe exacte du nom.";
        require view('players/player-form', compact('heading', 'errors', 'isLogged'));
        exit;
    }
    
    // Ajouter le joueur
    $db->insertPlayer($player);
    
    // Récupérer et sauvegarder ses lifetime stats
    $lifetimeStats = getPlayerLifetimeStats($player->id, $PUBG_API_KEY);
    if ($lifetimeStats) {
        $totalStats = calculateTotalStats($lifetimeStats);
        // On peut stocker ces stats dans le JSON assets ou créer une nouvelle colonne
        // Pour l'instant, on va les stocker temporairement dans la session pour l'affichage
        $_SESSION['latest_player_stats'] = [
            'player_id' => $player->id,
            'stats' => $totalStats,
            'detailed_stats' => $lifetimeStats
        ];
    }

    // Rediriger vers la team avec un message de succès
    $_SESSION['success_message'] = "Joueur '{$player->attributes->name}' ajouté avec succès à l'équipe !";
    redirect("/players");
    exit;
}

//hmidoulye