<?php

namespace Database\Factories;

use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "title" => $this->faker->sentence(),
            "description" => $this->faker->catchPhrase,
            "weight" => $this->faker->numberBetween(0, 50),
            "compare_at_price" => $this->faker->numberBetween(0, 50),
            "currency_code" => 'USD',
            "store_id" => Store::factory(),
            "handle" => $this->faker->text(12),
            "upc" => $this->faker->text(12),
            "ean" => $this->faker->text(12),
            "jan" => $this->faker->text(12),
            "isbn" => $this->faker->text(12),
            "mpn" => $this->faker->text(12),
            "location" => $this->faker->text(12),
            "tax_class" => '',
            "date_available" => Carbon::now(),
            "length" => $this->faker->numberBetween(0, 50),
            "width" => $this->faker->numberBetween(0, 50),
            "height" => $this->faker->numberBetween(0, 50),
            "brand_id" => 1,
            "sort_attribute" => '',
            "has_variants" => 0,
            "country_of_origin" => 'Nigeria',
            "step" => '',
            "sell_out_of_stock" => 0,
            "quantity" => $this->faker->randomFloat(),
            "custom_product_type_id" => 2,
            "product_type_id" => 2,
            "is_draft" => 0,
            "is_published" => 1,
        ];
    }


}
