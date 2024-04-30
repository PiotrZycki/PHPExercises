<?php

namespace Concept;

abstract class Distinguishable
{
    private int $id;
    public function __construct(int $id)
    {
        $this->id = $id;
    }
    public function key(): string
    {
        return self::name()."_".$this->id;
    }
    private function name(): string
    {
        return str_replace('\\', '_', strtolower(static::class));
    }
}