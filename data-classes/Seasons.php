<?php

class Season
{
    /** @var Data[] */
    public array $data;
    public Links $links;
    public Meta $meta;

    /**
     * @param Data[] $data
     */
    public function __construct(
        array $data,
        Links $links,
        Meta $meta
    ) {
        $this->data = $data;
        $this->links = $links;
        $this->meta = $meta;
    }
}
