<?php

namespace Tests\Unit;

use Model\Post;
use Tests\Support\UnitTester;

class Test04_PostsCest
{
    public function create(UnitTester $I): void
    {
        $post = new Post(1);
        $I->assertNotEmpty($post);
    }
}
