<?php

class PlayerSeason
{
    public $data;
    public $links;

    // Constructor that initializes properties from a JSON string
    function __construct($jsonString)
    {
        // Decode the JSON string into an associative array
        $jsonArray = json_decode($jsonString, true);

        // Extract and set the 'data' part, which may include player, matches, and stats
        if (isset($jsonArray['data'])) {
            $this->data = array_map(function ($entry) {
                return new PlayerSeasonData($entry);
            }, $jsonArray['data']);
        }

        // Extract and set the 'links' part
        if (isset($jsonArray['links'])) {
            $this->links = new SeasonPlayerLinks($jsonArray['links']['self']);
        }

       
    }
}

class PlayerSeasonData
{
    public $type;
    public $attributes;
    public $relationships;

    function __construct($data)
    {
        $this->type = $data['type'];
        if (isset($data['attributes'])) {
            $this->attributes = new PlayerSeasonAttributes($data['attributes']);
        }
        if (isset($data['relationships'])) {
            $this->relationships = new PlayerSeasonRelationships($data['relationships']);
        }



    }
}

class PlayerSeasonAttributes
{
    public $gameModeStats;
    public $bestRankPoint;

    function __construct($attributes)
    {
        if (isset($attributes['gameModeStats'])) {
            $this->gameModeStats = new GameModeStats($attributes['gameModeStats']);
        }
        $this->bestRankPoint = $attributes['bestRankPoint'];
    }
}

class GameModeStats
{
    public $squad;

    function __construct($stats)
    {
        $this->squad = new SquadStats($stats['squad']);
    }
}

class SquadStats
{
    // All the fields
    public $assists, $boosts, $dBNOs, $dailyKills, $dailyWins, $damageDealt, $days,
        $headshotKills, $heals, $killPoints, $kills, $longestKill, $longestTimeSurvived,
        $losses, $maxKillStreaks, $mostSurvivalTime, $rankPoints, $rankPointsTitle,
        $revives, $rideDistance, $roadKills, $roundMostKills, $roundsPlayed,
        $suicides, $swimDistance, $teamKills, $timeSurvived, $top10s, $vehicleDestroys,
        $walkDistance, $weaponsAcquired, $weeklyKills, $weeklyWins, $winPoints, $wins;

    // Constructor
    function __construct($stats)
    {
        foreach ($stats as $key => $value) {
            $this->$key = $value;
        }
    }

    // Method to instantiate from JSON
    public function fromJSON($json)
    {
        $data = json_decode($json, true);
        foreach ($data['attributes']['gameModeStats']['squad'] as $key => $value) {
            $this->$key = $value;
        }
    }

    // Get individual performance stats
    public function getIndividualStats()
    {
        return [
            'kills' => $this->kills,
            'headshotKills' => $this->headshotKills,
            'longestKill' => $this->longestKill,
            'damageDealt' => $this->damageDealt,
        ];
    }

    // Get collective contribution stats
    public function getCollectiveStats()
    {
        return [
            'assists' => $this->assists,
            'revives' => $this->revives,
            'heals' => $this->heals,
            'boosts' => $this->boosts,
        ];
    }

    // Get strategic metrics
    public function getStrategicStats()
    {
        return [
            'rideDistance' => $this->rideDistance,
            'swimDistance' => $this->swimDistance,
            'walkDistance' => $this->walkDistance,
            'vehicleDestroys' => $this->vehicleDestroys,
            'top10s' => $this->top10s,
        ];
    }
}

class SeasonPlayerLinks
{
    public $self;

    function __construct($self)
    {
        $this->self = $self;
    }
}
class PlayerSeasonRelationships
{
    public $matchesSquad;
    // Add other relationships here

    function __construct($matchesSquad)
    {
        $this->matchesSquad = $matchesSquad;
    }
}

class MatchData
{
    public $data;

    function __construct($data)
    {
        $this->data = $data;
    }
}
