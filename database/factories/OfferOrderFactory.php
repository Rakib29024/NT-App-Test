<?php

namespace Database\Factories;

use App\Models\OfferOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

class OfferOrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OfferOrder::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_qty_min' => rand(3,7),
            'total_product_price_min' => rand(1000,9999),
            'expiry_date' => date('y-m-d'),
            'discount' => rand(10,30)
        ];
    }
}
