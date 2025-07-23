<?php
function dd($data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die();
}


function getPlayerSeasonStats($playerOne, $seasonId, $PUBG_API_KEY)
{
    try {
        // Init cURL session
        $url = "https://api.pubg.com/shards/xbox/seasons/{$seasonId}/gameMode/squad/players?filter[playerIds]={$playerOne->id}";
        $ch = curl_init($url);

        // Set the HTTP headers and options
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/vnd.api+json',
            'Authorization: Bearer ' . $PUBG_API_KEY,
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        $response = curl_exec($ch);
        if ($response === false) {
            throw new Exception(curl_error($ch), curl_errno($ch));
        }

        $responseData = json_decode($response, true);
        $playerSeasonStats = new PlayerSeason(json_encode($responseData));
        $playerSeasonStats = $playerSeasonStats->data[0];
        curl_close($ch);

        return $playerSeasonStats;
    } catch (Exception $e) {
        return null;
    }
}
function getPlayerListSeasonStats(array $playersAccountsIds, $seasonId, $PUBG_API_KEY)
{
    try {
        // Init cURL session
        $playersStr = implode(',', $playersAccountsIds);
        $url = "https://api.pubg.com/shards/xbox/seasons/{$seasonId}/gameMode/squad/players?filter[playerIds]={$playersStr}";
        $ch = curl_init($url);

        // Set the HTTP headers and options
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/vnd.api+json',
            'Authorization: Bearer ' . $PUBG_API_KEY,
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        $response = curl_exec($ch);
        if ($response === false) {
            throw new Exception(curl_error($ch), curl_errno($ch));
        }

        $responseData = json_decode($response, true);
        
        // Vérifier si la réponse contient des données
        if (!isset($responseData['data']) || !is_array($responseData['data'])) {
            curl_close($ch);
            return [];
        }
        
        $playerSeasonStats = array_map(function ($player) {
            return new PlayerSeasonData($player);
        }, $responseData['data']);

        curl_close($ch);

        return $playerSeasonStats;
    } catch (Exception $e) {
        return null;
    }
}

function getPlayer(
    $playerName,
    $PUBG_API_KEY,
    $shardId = 'xbox',
) {
    try {
        $playerName = urlencode($playerName);
        // Init cURL session
        $url = "https://api.pubg.com/shards/{$shardId}/players?filter[playerNames]={$playerName}";
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);

        // Set the HTTP headers and options
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/vnd.api+json',
            'Authorization: Bearer ' . $PUBG_API_KEY,
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        $response = curl_exec($ch);
        if ($response === false) {
            throw new Exception(curl_error($ch), curl_errno($ch));
        }

        if (isFetchError($response)) {
            return null;
        }
        $responseData = json_encode(json_decode($response, true)['data'][0]);
        $player =  Player::fromJSON($responseData);
        curl_close($ch);

        return $player;
    } catch (Exception $e) {
        return null;
    }
}

function getPlayerLifetimeStats($playerId, $PUBG_API_KEY, $shardId = 'xbox') {
    try {
        $url = "https://api.pubg.com/shards/{$shardId}/players/{$playerId}/seasons/lifetime";
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/vnd.api+json',
            'Authorization: Bearer ' . $PUBG_API_KEY,
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        $response = curl_exec($ch);
        if ($response === false) {
            throw new Exception(curl_error($ch), curl_errno($ch));
        }

        $responseData = json_decode($response, true);
        curl_close($ch);

        if (isset($responseData['errors'])) {
            return null;
        }

        return $responseData['data']['attributes']['gameModeStats'] ?? null;
    } catch (Exception $e) {
        return null;
    }
}

function calculateTotalStats($gameModeStats) {
    $totals = [
        'kills' => 0,
        'wins' => 0,
        'losses' => 0,
        'roundsPlayed' => 0,
        'damageDealt' => 0,
        'timeSurvived' => 0,
        'headshotKills' => 0,
        'longestKill' => 0
    ];
    
    $modes = ['solo', 'duo', 'squad', 'solo-fpp', 'duo-fpp', 'squad-fpp'];
    
    foreach ($modes as $mode) {
        if (isset($gameModeStats[$mode])) {
            $stats = $gameModeStats[$mode];
            $totals['kills'] += $stats['kills'] ?? 0;
            $totals['wins'] += $stats['wins'] ?? 0;
            $totals['losses'] += $stats['losses'] ?? 0;
            $totals['roundsPlayed'] += $stats['roundsPlayed'] ?? 0;
            $totals['damageDealt'] += $stats['damageDealt'] ?? 0;
            $totals['timeSurvived'] += $stats['timeSurvived'] ?? 0;
            $totals['headshotKills'] += $stats['headshotKills'] ?? 0;
            $totals['longestKill'] = max($totals['longestKill'], $stats['longestKill'] ?? 0);
        }
    }
    
    return $totals;
}


function isFetchError($response)
{

    if (isset(json_decode($response, true)['errors'])) {

        return true;
    } else {
        return  false;
    }
}

function view($name, $data = [])
{
    extract($data);
    return base_path("/views/{$name}.view.php");
}

function redirect($path)
{
    header("Location: {$path}");
}

function base_path($path = '')
{
    return BASE_PATH . $path;
}

function isLogged()
{
    return $_SESSION['user']['isLogged'] ?? false;
}

function dsn($DB_HOST, $DB_PORT, $DB_NAME)
{
    return "mysql:host={$DB_HOST};port={$DB_PORT};dbname={$DB_NAME}";
}