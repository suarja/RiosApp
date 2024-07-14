<?php

class SeasonsLinks
{
    public string $self;

    public function __construct(string $self)
    {
        $this->self = $self;
    }

    public static function fromArray(array $data): SeasonsLinks
    {
        return new SeasonsLinks(
            $data["self"]
        );
    }
}
