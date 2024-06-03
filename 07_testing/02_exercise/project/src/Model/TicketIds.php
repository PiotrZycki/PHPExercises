<?php

namespace Model;

use Concept\Distinguishable;

class TicketIds extends Distinguishable
{
    public function __construct()
    {
        parent::__construct(0);
        $this->nextTicketId = 1;
    }

    public int $nextTicketId;
}
