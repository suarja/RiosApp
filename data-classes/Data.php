<?php

class Data
{
    public string $type;
    public string $id;

    public function __construct(string $type, string $id)
    {
        $this->type = $type;
        $this->id = $id;
    }

    public static function fromArray(array $array): Data
    {
        return new Data(
            $array["type"],
            $array["id"]
        );
    }
}
