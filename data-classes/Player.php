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


    // Static method to create a Player from a database array
    public static function fromDB(array $dbArray): Player
    {
        $attributes = new Attributes(
            $dbArray['stats'] ?? "",
            $dbArray['title_id'],
            $dbArray['shard_id'],
            $dbArray['clan_id'],
            $dbArray['name'],
            $dbArray['ban_type'],
            $dbArray['patch_version']
        );

        $assets = new Assets(json_decode($dbArray['assets_json'], true));
        $matches = new Matches(json_decode($dbArray['matches_json'], true));

        $relationships = new Relationships($assets, $matches);

        $links = new Links(
            $dbArray['link_self'],
            $dbArray['link_schema']  // Assuming this might be empty but structured for future use
        );

        return new Player(
            $dbArray['type'],
            $dbArray['id'],
            $attributes,
            $relationships,
            $links
        );
    }
}
