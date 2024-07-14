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

    public static function fromArray(array $data): SeasonAttributes
    {
        return new SeasonAttributes(
            $data["isCurrentSeason"],
            $data["isOffseason"]
        );
    }
}
