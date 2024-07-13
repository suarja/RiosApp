<?php

class Attributes
{
    public null $stats;
    public string $titleId;
    public string $shardId;
    public string $patchVersion;
    public string $banType;
    public string $clanId;
    public string $name;

    public function __construct(
        null $stats,
        string $titleId,
        string $shardId,
        string $patchVersion,
        string $banType,
        string $clanId,
        string $name
    ) {
        $this->stats = $stats;
        $this->titleId = $titleId;
        $this->shardId = $shardId;
        $this->patchVersion = $patchVersion;
        $this->banType = $banType;
        $this->clanId = $clanId;
        $this->name = $name;
    }
}
