<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Order;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Task3APITest extends TestCase
{
    use RefreshDatabase,WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_get_pending_order_list()
    {
        $orders=Order::factory()->create();
        $response = $this->json('GET', route('order.index'));
        $response->assertStatus(200);

        $response->assertJsonStructure(
            [
                'pendingOrders' =>
                    [
                        '*' => [
                            'user_id',
                            'orderID',
                            'mobile',
                            'address',
                            'status'
                       ]
                    ]
            ]
        );
    }
    public function test_can_update_stock()
    {
        $order=Order::factory()->create();
        $formData=[
            "status" => 'delivered',
        ];
        $this->withoutExceptionHandling();
        $this->json('PUT',route('order.update',$order->id),$formData)->assertStatus(200);
    }
}
