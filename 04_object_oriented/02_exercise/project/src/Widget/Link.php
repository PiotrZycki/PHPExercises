<?php

namespace Widget;
use Concept\Distinguishable;

class Link extends Widget
{
    public function draw(): void
    {
        echo '<a href="">'.parent::key().'</a>';
    }
}