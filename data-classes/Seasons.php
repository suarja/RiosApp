<?php

class Season
{
    /** @var Data[] */
    public array $data;
    public Links $links;
    public Meta $meta;

    /**
     * @param SeasonData[] $data
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

    public static function fromJSON(string $jsonString): Season
    {
        $data = json_decode($jsonString, true)["data"];
        $data = array_map(fn($data) => Data::fromArray($data), $data);
        $links = Links::fromArray(json_decode($jsonString, true)["links"]);
        $meta = Meta::fromArray(json_decode($jsonString, true)["meta"]);
        return new Season($data, $links, $meta);
    }
}
