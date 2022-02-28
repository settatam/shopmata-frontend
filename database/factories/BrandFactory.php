<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'page_title' => $this->faker->bs,
            'description' => $this->faker->realText,
            'meta_title' => $this->faker->catchPhrase,
            'slug' => $this->faker->slug,
            'meta_description' => $this->faker->realText(45),
            'meta_keyword' => $this->faker->word,
            'sort_order' => $this->faker->randomDigit,
        ];
    }
}
