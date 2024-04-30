<?php

namespace Concept;

use Webmozart\Assert\Assert;

abstract class Distinguishable
{
    private int $id;

    public function __construct(int $id)
    {
        Assert::integer($id, 'ID must be an integer. Got: %s');
        $this->id = $id;
    }

    public function key(): string
    {
        return $this->name() . "_" . $this->id;
    }

    private function name(): string
    {
        $withoutBackSlash = str_replace('\\', '_', static::class);
        return strtolower($withoutBackSlash);
    }
}
