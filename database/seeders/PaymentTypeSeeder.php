<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TransactionPaymentType;


class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        \DB::table('transaction_payment_types')->truncate();

        $paymentTypes = [
            '1' => 'Check',
            '2' => 'Paypal',
            '3' => 'ACH',
            '4' => 'Venmo',
            '5' => 'Wire Transfer',
            '6' => 'Bank Transfer (Nigeria)',
            '7' => 'CashApp'
        ];

        foreach ($paymentTypes as $key => $paymentType) {
            \DB::table('transaction_payment_types')->insert([
                'name' => $paymentType,
            ]); 
        }
    }
}


