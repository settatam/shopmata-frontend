<?php

namespace Database\Factories;

use App\Models\CartDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CartDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $variant = \App\Models\ProductVariant::all()->random()->sku;
        
        return [
            //
            "sku"=>$variant->sku, 
            "cart_id"=>Cart::inRandomOrder()->first()->id, 
            "price"=>$variant->price, 
        ];
    }
}
