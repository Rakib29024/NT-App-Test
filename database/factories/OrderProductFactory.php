<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Stock;
use App\Models\OrderProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => Order::factory(),
            'stock_id' => Stock::factory(),
            'quantity' => rand(10,80),
            'totalProductPrice' => rand(1000,5000),
            'deliveryCost' => $this->faker->randomElement([60,100])
        ];
    }
}
