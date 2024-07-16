<?php

class Container
{
    protected $bindings = [];

    public function bind($key, $value)
    {
        $this->bindings[$key] = $value;
    }

    public function resolve($key)
    {
        if (!array_key_exists($key, $this->bindings)) {
            throw new Exception("Key {$key} not found in container");
        }

        if (isset($this->bindings[$key])) {
            return call_user_func($this->bindings[$key]);
        }
    }
}
