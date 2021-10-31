<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $sub_total = $this->faker->numberBetween($min = 1500, $max = 20000);
        $sales_tax = $this->faker->boolean ? 0.00 : 5*$sub_total/100;
        $shipping = $this->faker->boolean ? 0.00 : 1500;
        $discount = $this->faker->boolean ? 0.00 : 10*$sub_total/100;
        $total = $sub_total + $shipping + $sales_tax - $discount;
        
        return [
            //
            'customer_id'=>\App\Models\Customer::all()->random()->id,
            'total'=>$total,
            'status'=>$this->faker->randomElement(
                [   'pending', 
                    'confirmed',
                    'cancelled',
                    'fulfilled',
                    'returned',
                    'refunded',
                    'shipped',
                    'delivered'
                ]
            ),

            'store_id'=>2,
            'payment_gateway_id'=>\App\Models\PaymentGateway::all()->random()->id,
            'sales_tax'=>$sales_tax,
            'shipping_cost'=>$shipping,
            'discount_cost'=>$discount,
            'cart_id'=>Cart::factory(),
            'sub_total'=>$sub_total,
            'shipping_weight'=>$this->faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 30),
            'order_id'=>$this->faker->numerify('TBH######'),
            'shipping_gateway_id'=>\App\Models\ShippingGateway::all()->random()->id
        ];
    }
}
