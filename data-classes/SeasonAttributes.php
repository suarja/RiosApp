<?php

class SeasonAttributes
{
    public bool $isCurrentSeason;
    public bool $isOffseason;

    public function __construct(bool $isCurrentSeason, bool $isOffseason)
    {
        $this->isCurrentSeason = $isCurrentSeason;
        $this->isOffseason = $isOffseason;
    }
}
