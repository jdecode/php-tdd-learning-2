<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\BuyerController;

class BuyerTest extends TestCase
{
    #use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    /*
    public function testCheckEmail()
    {
        $buyer = new BuyerController();
        $buyer->save(
            [
                'name' => 'Name2',
                'email' => 'abc2@ggg.com',
                'firstName' => 'FN1',
                'lastName' => 'LN1',
                'password' => '123',
            ]
        );
        $this->assertInstanceOf(BuyerController::class, $buyer);
    }
    */
}
