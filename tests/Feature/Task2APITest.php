<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Stock;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Task2APITest extends TestCase
{
    use RefreshDatabase,WithFaker;
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
            "stock_id"=> [$stock->id,$stock->id],
            "quantity"=> [$this->faker->randomElement([1, 2]),$this->faker->randomElement([1, 2])],
            "preOrderCode"=>""
        ];
        $this->withoutExceptionHandling();
        $response=$this->json('POST',route('order.store'),$formData)->assertStatus(200);
        
        $response->assertJsonStructure(
            [
                'invoice' 
                    =>[
                    'orderInfo'=>[
                        'user_id',
                        'mobile',
                        'address',
                        'orderID'
                    ],
                    'orderProducts'=>[
                        '*'=>[
                            'productName',
                            'order_id',
                            'stock_id',
                            'totalProductPrice',
                            'deliveryCost'
                        ]
                    ]
                ]
            ]
        );
    }

}
