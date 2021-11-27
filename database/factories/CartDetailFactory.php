<?php

namespace Database\Factories;

use App\Models\CartDetail;
use App\Models\Cart;
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
        $variant = \App\Models\ProductVariant::all()->random();
        
        return [
            //
            "sku"=>$variant->sku, 
            "cart_id"=>Cart::all()->random()->id, 
            "price"=>$variant->price, 
        ];
    }
}
