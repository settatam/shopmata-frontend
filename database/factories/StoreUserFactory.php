<?php

namespace Database\Factories;

use App\Models\StoreUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StoreUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'order_id'=>$faker->unique()->numberBetween(113, 162),
            'address'=>$faker->streetAddress,
            'address2'=>$faker->secondaryAddress,
            'city'=>$faker->city,
            'state_id'=>$faker->numberBetween(54,89),
            'country_id'=>158,
            'zip'=>$faker->postal_code,
            'phone'=>$faker->mobileNumber,
        ];
    }
}
