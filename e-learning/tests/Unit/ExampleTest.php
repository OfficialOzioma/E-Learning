<?php

namespace Tests\Unit;

use Illuminate\Support\Manager;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use database\connectors\ManagerData;
use database\connectors\UserData;
class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest(){
        UserData::insertUser('pekka','pekka',2,'127.0.0.1');
        $this->assertTrue(true);
    }
}
