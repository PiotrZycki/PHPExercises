<?php

namespace Widget;
use Concept\Distinguishable;

class Button extends Widget
{
    public function draw(): void
    {
        echo '<input type="button" value="'.parent::key().'">';
    }
}