<?php

namespace Database\Factories;

use App\Models\ProductName;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Stock::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => ProductName::factory(),
            'weight' => $this->faker->randomElement([100, 150, 200, 400]),
            'tasteType' => $this->faker->randomElement(['sweet', 'sour', 'bitter']),
            'pricePerBox' => $this->faker->randomElement([1000, 1500, 2000, 4000]),
            'boxQuantity' => $this->faker->randomElement([10, 15, 20, 40]),
        ];
    }
}
