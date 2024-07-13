<?php

class Matches
{
    /** @var Data[] */
    public array $data;

    /**
     * @param Data[] $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }
}
