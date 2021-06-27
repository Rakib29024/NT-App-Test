<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Task2APITest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_create_order()
    {
        $user=User::factory()->create();
        $stock=Stock::factory()->create();
        $formData=[
            "user_id"=> $user->id,
            "orderID"=> rand(111111,9999999).date('ymdhmi'),
            "mobile"=> $this->faker->phoneNumber,
            "address"=> $this->faker->randomElement(['chitagong', 'feni', 'dhaka']),
            "stock_id"=> $stock->id,
            "quantity"=> $this->faker->randomElement([5, 3, 7, 10]),
        ];
        $this->withoutExceptionHandling();
        $this->json('POST',route('order.store'),$formData)->assertStatus(200);
    }

}
