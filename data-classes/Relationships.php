<?php

require 'Assets.php';
require 'Matches.php';

class Relationships
{
    public Assets $assets;
    public Matches $matches;

    public function __construct(Assets $assets, Matches $matches)
    {
        $this->assets = $assets;
        $this->matches = $matches;
    }
}
