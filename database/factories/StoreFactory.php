<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "slug" => $this->faker->slug,
            "url" => $this->faker->url,
            "name" => $this->faker->company,
            "account_email" => $this->faker->email,
            "customer_email" => $this->faker->email,
            "business_name" => $this->faker->company,
            "address" => $this->faker->address,
            "address2" => $this->faker->address,
            "city" => $this->faker->city,
            "state" => $this->faker->word,
            "country_id" => $this->faker->numberBetween(1, 242),
            "timezone_id" => $this->faker->numberBetween(1, 102),
            "unit_id" => $this->faker->numberBetween(1, 8),
            "default_weight_unit_id" => $this->faker->numberBetween(0, 8),
            "theme_id" => 1,
            "is_active" => 1,
            "meta_description" => $this->faker->realText,
            "meta_title" => $this->faker->catchPhrase,
            "phone" => $this->faker->e164PhoneNumber,
            "zip" => $this->faker->numberBetween(11111, 99999),
            "store_domain" => $this->faker->domainName,
            "industry_id" => $this->faker->numberBetween(1, 13),
            "order_id_suffix" => $this->faker->word,
            "order_id_prefix" => $this->faker->word,
            "gift_card_should_expire" => 0,
            "gift_card_expire_after" => 1,
            "gift_card_expiry_duration" => $this->faker->realText(45),
            "store_plan_id" => 1,
            "last_payment_date" => Carbon::yesterday(),
            "next_payment_date" => Carbon::tomorrow(),
            "allow_guest_checkout" => 1,
            "payment_system_id" => 1,
            "enable_store_pickup" => 1,
            "enable_pay_on_delivery" => 1,
            "step" => 1,
            "state_id" => $this->faker->numberBetween(1, 89),
            "storescol" => $this->faker->realText(45),
            'user_id' => 1
        ];
    }
}
