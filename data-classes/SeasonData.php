<?php

class SeasonData
{
    public string $type;
    public string $id;
    public Attributes $attributes;

    public function __construct(
        string $type,
        string $id,
        SeasonAttributes $attributes
    ) {
        $this->type = $type;
        $this->id = $id;
        $this->attributes = $attributes;
    }
}
