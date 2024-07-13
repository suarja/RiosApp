<?php

$playerOnePath = "data/player-1.json";
$playerOneJsonString = file_get_contents($playerOnePath);
$playerOne = json_decode($playerOneJsonString, true);
$playerOne = new Player(
    $playerOne['type'],
    $playerOne['id'],
    new Attributes(
        $playerOne['attributes']['stats'] ?? "",
        $playerOne['attributes']['titleId'],
        $playerOne['attributes']['shardId'],
        $playerOne['attributes']['clanId'],
        $playerOne['attributes']['name'],
        $playerOne['attributes']['banType'],
        $playerOne['attributes']['patchVersion'],


    ),
    new Relationships(
        new Assets(
            $playerOne['relationships']['assets']['data'],

        ),
        new Matches(
            $playerOne['relationships']['matches']['data'],
        ),
    ),
    new Links(
        $playerOne['links']['self'],
        $playerOne['links']['schema'],
    ),
);
