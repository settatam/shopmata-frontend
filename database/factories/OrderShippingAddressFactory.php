<?php

namespace Database\Factories;

use App\Models\OrderShippingAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderShippingAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderShippingAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'order_id'=>$this->faker->unique()->numberBetween($min=113, $max=162),
            'address'=>$this->faker->streetAddress,
            'address2'=>$this->faker->secondaryAddress,
            'city'=>$this->faker->city,
            'state_id'=>$this->faker->numberBetween($min=54,$max=89),
            'country_id'=>158,
            'zip'=>$this->faker->postcode,
            'phone'=>$this->faker->phoneNumber,
        ];
    }
}
