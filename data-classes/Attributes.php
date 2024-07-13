<?php

class Attributes
{
    public string $stats;
    public string $titleId;
    public string $shardId = "xbox";
    public string $patchVersion = "";
    public string $banType = "Innocent";
    public string $clanId;
    public string $name;

    public function __construct(
        string $stats,
        string $titleId,
        string $shardId,
        string $clanId,
        string $name,
        string $banType= "Innocent",
        string $patchVersion = "",
    ) {
        $this->stats = $stats;
        $this->titleId = $titleId;
        $this->shardId = $shardId;
        $this->banType = $banType;
        $this->clanId = $clanId;
        $this->name = $name;
        $this->patchVersion = $patchVersion;
    }
}
