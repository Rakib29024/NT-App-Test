<?php

namespace Tests\Feature;

use App\Models\ProductName;
use App\Models\Stock;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Task1APITest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_get_all_product()
    {
        $product=ProductName::factory()->create();
        $response = $this->json('GET', route('product.index'));
        $response->assertStatus(200);

        $response->assertJsonStructure(
            [
                'data' =>
                    [
                        '*' => [
                            'id',
                            'name'
                       ]
                    ]
            ]
        );

    }

    public function test_can_create_product()
    {
        $formData=[
            "name"=> "mango"
        ];
        $this->withoutExceptionHandling();
        $this->json('POST',route('product.store'),$formData)->assertStatus(200);
    }

    public function test_can_create_stock()
    {
        $formData=[
            "product_id"=> 13,
            "weight"=> 200,
            "tasteType"=> "sour",
            "pricePerBox"=> 2000,
            "boxQuantity"=> 10
        ];
        $this->withoutExceptionHandling();
        $this->json('POST',route('stock.store'),$formData)->assertStatus(200);
    }

    public function test_can_update_stock()
    {
        $stock=Stock::factory()->create();
        $formData=[
            "pricePerBox" => 300,
            "boxQuantity" => 30
        ];
        $this->withoutExceptionHandling();
        $this->json('PUT',route('stock.update',$stock->id),$formData)->assertStatus(200);
    }
}
