<?php

namespace Application\Models\Entities;

abstract class Entity
{
    public function __get(string $name)
    {
        if (property_exists($this, $name)) {
            return $this->{$name};
        }
    }

    public function __set(string $name, $value)
    {
        if (property_exists($this, $name)) {
            $this->{$name} = $value;
        }
    }

    public function __isset($property)
    {
        return isset($this->{$property});
    }
}
