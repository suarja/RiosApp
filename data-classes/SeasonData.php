<?php

class SeasonData
{
    public string $type;
    public string $id;
    public SeasonAttributes $attributes;

    public function __construct(
        string $type,
        string $id,
        SeasonAttributes $attributes
    ) {
        $this->type = $type;
        $this->id = $id;
        $this->attributes = $attributes;
    }

    public static function fromArray(array $data): SeasonData
    {
        return new SeasonData(
            $data["type"],
            $data["id"],
            SeasonAttributes::fromArray($data["attributes"])
        );
    }
}
