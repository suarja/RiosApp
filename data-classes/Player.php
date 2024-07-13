<?php

class Player
{
    public string $type;
    public string $id;
    public Attributes $attributes;
    public Relationships $relationships;
    public Links $links;

    public function __construct(
        string $type,
        string $id,
        Attributes $attributes,
        Relationships $relationships,
        Links $links
    ) {
        $this->type = $type;
        $this->id = $id;
        $this->attributes = $attributes;
        $this->relationships = $relationships;
        $this->links = $links;
    }

    public static function fromJSON(
        string $jsonString
    ): Player {
        $player = json_decode($jsonString, true);
        return new Player(
            $player['type'],
            $player['id'],
            new Attributes(
                $player['attributes']['stats'] ?? "",
                $player['attributes']['titleId'],
                $player['attributes']['shardId'],
                $player['attributes']['clanId'],
                $player['attributes']['name'],
                $player['attributes']['banType'],
                $player['attributes']['patchVersion'],
            ),
            new Relationships(
                new Assets(
                    $player['relationships']['assets']['data'],
                ),
                new Matches(
                    $player['relationships']['matches']['data'],
                ),
            ),
            new Links(
                $player['links']['self'],
                $player['links']['schema'],
            ),
        );
    }
}
