<?php

namespace Model;

use Concept\Distinguishable;

class Ticket extends Distinguishable
{
    public string $name;
    public string $surname;
    public string $email;
    public int $normal;
    public int $discounted;

}
