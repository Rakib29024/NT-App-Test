<?php

namespace Tests\Feature;

use App\Models\OfferOrder;
use Tests\TestCase;
use App\Models\User;
use App\Models\Stock;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Task4APITest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_order_with_offer()
    {
        $user=User::factory()->create();
        $stock=Stock::factory()->create();
        $offerOrder=OfferOrder::factory()->create();
        $formData=[
            "user_id"=> $user->id,
            "orderID"=> rand(111111,9999999).date('ymdhmi'),
            "mobile"=> $this->faker->phoneNumber,
            "address"=> $this->faker->randomElement(['chitagong', 'feni', 'dhaka']),
            "stock_id"=> [$stock->id,$stock->id],
            "quantity"=> [$this->faker->randomElement([5, 3, 7, 10]),$this->faker->randomElement([5, 3, 7, 10])],
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
    public function test_can_order_with_preOrderCode()
    {
        $user=User::factory()->create();
        $stock=Stock::factory()->create();
        $formData=[
            "user_id"=> $user->id,
            "orderID"=> rand(111111,9999999).date('ymdhmi'),
            "mobile"=> $this->faker->phoneNumber,
            "address"=> $this->faker->randomElement(['chitagong', 'feni', 'dhaka']),
            "stock_id"=> [$stock->id,$stock->id],
            "quantity"=> [$this->faker->randomElement([5, 3, 7, 10]),$this->faker->randomElement([5, 3, 7, 10])],
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
