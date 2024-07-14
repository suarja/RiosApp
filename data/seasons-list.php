<?php
$seasonsListPath = "./data/seasons.json";
$seasonsListJsonString = file_get_contents($seasonsListPath);
$seasonsList = Season::fromJson($seasonsListJsonString);
$currentSeason;
foreach ($seasonsList->data as $season) {
    if ($season->attributes->isCurrentSeason) {
        $currentSeason = $season;
        break;
    }
}

$seasonId = $currentSeason->id;

