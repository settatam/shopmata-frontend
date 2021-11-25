<?php

namespace Database\Factories;

use App\Models\OrderActivity;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderActivityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderActivity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'order_id'=>$this->faker->numberBetween($min = 113, $max = 162),
            'activity'=>$this->faker->sentence($nbWords = 8, $variableNbWords = true)
        ];
    }
}
