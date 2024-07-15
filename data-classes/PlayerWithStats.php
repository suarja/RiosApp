<?php
class PlayerWithStats
{
    public $player;
    public $playerSeasonStats;
    public function __construct($player, $playerSeasonStats)
    {
        $this->player = $player;
        $this->playerSeasonStats = $playerSeasonStats;
    }

    public function stat($stat)
    {
        if ($stat == "kd") {
            return $this->playerSeasonStats->attributes->gameModeStats->squad->kills / $this->playerSeasonStats->attributes->gameModeStats->squad->losses;
        }
        return $this->playerSeasonStats->attributes->gameModeStats->squad->$stat;
    }
}
