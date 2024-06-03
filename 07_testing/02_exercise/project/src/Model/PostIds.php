<?php

namespace Model;

use Concept\Distinguishable;

class PostIds extends Distinguishable
{
    public function __construct()
    {
        parent::__construct(0);
        $this->nextPostId = 1;
    }

    public int $nextPostId;
}
