<?php
require 'Attributes.php';
require 'Relationships.php';
require 'Links.php';

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
}
