<?php
require "./data-classes/index.php";
$seasonsListPath = "./seasons-list.json";
$seasonsListJsonString = file_get_contents($seasonsListPath);
$seasonsList = Season::fromJSON($seasonsListJsonString);
$currentSeason = array_filter($seasonsList->data, fn ($season) => $season->data->isCurrentSeason === true)[0];
// $seasonId = $currentSeason->data->id;
