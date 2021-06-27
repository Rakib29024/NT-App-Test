<?php

namespace Database\Factories;

use App\Models\ProductName;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductNameFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductName::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name()
        ];
    }
}
