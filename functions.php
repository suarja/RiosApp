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
}

function getPlayer(
    $playerName,
    $PUBG_API_KEY,
    $shardId = 'xbox',
) {
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

    $responseData = json_encode(json_decode($response, true)['data'][0]);
    $player =  Player::fromJSON($responseData);
    curl_close($ch);

    return $player;
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
