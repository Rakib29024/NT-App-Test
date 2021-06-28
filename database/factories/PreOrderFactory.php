<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\PreOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

class PreOrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PreOrder::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'preOrderCode' => rand(1000,9999).'OP'.date('mdi'),
            'expiry_date' => date('y-m-d'),
            'status' => $this->faker->randomElement(['active', 'completed']),
        ];
    }
}
