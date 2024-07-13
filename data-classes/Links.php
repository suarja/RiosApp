<?php

class Links
{
    public string $self;
    public string $schema;

    public function __construct(string $self, string $schema)
    {
        $this->self = $self;
        $this->schema = $schema;
    }
}
