<?php

namespace Database\Factories;

use App\Models\ProductVariantAttribute;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductVariantAttributeFactory extends Factory
{
    protected $model = ProductVariantAttribute::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'attribute' => $this->faker->word,
            'value' => $this->faker->word,
        ];
    }
}
