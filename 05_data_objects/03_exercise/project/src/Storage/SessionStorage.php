<?php

namespace Storage;

use Concept\Distinguishable;
use Storage\Storage;

class SessionStorage implements Storage
{
    public function __construct()
    {
        session_start();
    }
    public function store(Distinguishable $distinguishable): void
    {
        $_SESSION[$distinguishable->key()] = $distinguishable;
    }

    /**
     * @inheritDoc
     */
    public function loadAll(): array
    {
        $result = [];

        foreach ($_SESSION as $value) {
            $result[] = $value;
        }
        return $result;
    }
}
