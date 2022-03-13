<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductVariantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sku' => $this->faker->word,
            'price' => $this->faker->numberBetween(0, 50),
            'quantity' => $this->faker->numberBetween(0, 50),
            'barcode' => $this->faker->word,
            'is_active' => true,
            'product_id' => Product::factory(),
        ];
    }
}
