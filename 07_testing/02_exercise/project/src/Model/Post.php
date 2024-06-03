<?php

namespace Model;

use Concept\Distinguishable;

class Post extends Distinguishable
{
    public string $title;
    public string $text;
    public int $num;

    public function draw(): void
    {
        echo '<div>';
        echo '<h3>' . $this->title . '</h3>';
        echo '<a href="/feed/'.$this->num.'">Read more</a>';
        echo '</div>';
        echo '<br/>';
    }
    public function drawPost(): void
    {
        echo '<div>';
        echo '<h3>' . $this->title . '</h3>';
        echo '<p>' . $this->text . '</p>';
        echo '</div>';
        echo '<br/>';
    }
}
