<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StoreNotificationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('store_notifications')->delete();
        
        \DB::table('store_notifications')->insert(array (
            0 => 
            array (
                'id' => 23,
                'name' => 'Order confirmation',
                'store_notification_category_id' => 1,
                'created_at' => '2020-02-02 02:01:01',
                'updated_at' => '2020-02-02 02:01:01',
                'description' => 'Sent automatically to the customer after they place their order.',
                'content' => 'This is the default message and should be edited forOrder confirmation',
            ),
            1 => 
            array (
                'id' => 24,
                'name' => 'Order edited',
                'store_notification_category_id' => 1,
                'created_at' => '2020-02-02 02:01:01',
                'updated_at' => '2020-02-02 02:01:01',
                'description' => '
Sent to the customer after their order is edited (if you select this option).',
                'content' => 'This is the default message and should be edited forOrder edited',
            ),
            2 => 
            array (
                'id' => 25,
                'name' => 'Order canceled',
                'store_notification_category_id' => 1,
                'created_at' => '2020-02-02 02:01:01',
                'updated_at' => '2020-02-02 02:01:01',
                'description' => '
Sent automatically to the customer if their order is canceled (if you select this option).',
                'content' => 'This is the default message and should be edited forOrder canceled',
            ),
            3 => 
            array (
                'id' => 26,
                'name' => 'Order edited invoice',
                'store_notification_category_id' => 1,
                'created_at' => '2020-02-02 02:01:01',
                'updated_at' => '2020-02-02 02:01:01',
                'description' => '
Sent to the customer after their order is edited and they owe money (if you select this option).',
                'content' => 'This is the default message and should be edited forOrder edited invoice',
            ),
            4 => 
            array (
                'id' => 27,
                'name' => 'Order invoice

',
                'store_notification_category_id' => 1,
                'created_at' => '2020-02-02 02:01:01',
                'updated_at' => '2020-02-02 02:01:01',
                'description' => 'Sent to the customer when the order has an outstanding balance.',
                'content' => 'This is the default message and should be edited forOrder invoice

',
            ),
            5 => 
            array (
                'id' => 28,
                'name' => 'Order refund',
                'store_notification_category_id' => 1,
                'created_at' => '2020-02-02 02:01:01',
                'updated_at' => '2020-02-02 02:01:01',
            'description' => 'Sent automatically to the customer if their order is refunded (if you select this option).',
                'content' => 'This is the default message and should be edited forOrder refund',
            ),
            6 => 
            array (
                'id' => 29,
                'name' => 'Draft order invoice',
                'store_notification_category_id' => 1,
                'created_at' => '2020-02-02 02:01:01',
                'updated_at' => '2020-02-02 02:01:01',
                'description' => '
Sent to the customer when a draft order invoice is created. You can edit this email invoice before you send it.',
                'content' => 'This is the default message and should be edited forDraft order invoice',
            ),
            7 => 
            array (
                'id' => 30,
                'name' => 'Email cart from POS',
                'store_notification_category_id' => 1,
                'created_at' => '2020-02-02 02:01:01',
                'updated_at' => '2020-02-02 02:01:01',
                'description' => 'Sent to the customer when you email their cart from POS. Includes a link to buy online.',
                'content' => 'This is the default message and should be edited forEmail cart from POS',
            ),
            8 => 
            array (
                'id' => 31,
                'name' => 'Abandoned checkout',
                'store_notification_category_id' => 1,
                'created_at' => '2020-02-02 02:01:01',
                'updated_at' => '2020-02-02 02:01:01',
                'description' => 'Sent to the customer if they leave checkout before they buy the items in their cart.',
                'content' => 'This is the default message and should be edited forAbandoned checkout',
            ),
            9 => 
            array (
                'id' => 32,
                'name' => 'POS exchange receipt',
                'store_notification_category_id' => 1,
                'created_at' => '2020-02-02 02:01:01',
                'updated_at' => '2020-02-02 02:01:01',
                'description' => 'Sent to the customer after they complete an exchange in person and want to be emailed a receipt.',
                'content' => 'This is the default message and should be edited forPOS exchange receipt',
            ),
            10 => 
            array (
                'id' => 33,
                'name' => 'Gift card created',
                'store_notification_category_id' => 1,
                'created_at' => '2020-02-02 02:01:01',
                'updated_at' => '2020-02-02 02:01:01',
                'description' => '
Sent automatically to the customer when you issue or fulfill a gift card.',
                'content' => 'This is the default message and should be edited forGift card created',
            ),
            11 => 
            array (
                'id' => 34,
                'name' => 'Payment error',
                'store_notification_category_id' => 1,
                'created_at' => '2020-02-02 02:01:01',
                'updated_at' => '2020-02-02 02:01:01',
                'description' => 'Sent automatically to the customer if their payment can’t be processed.',
                'content' => 'This is the default message and should be edited forPayment error',
            ),
            12 => 
            array (
                'id' => 35,
                'name' => 'Fulfilment request',
                'store_notification_category_id' => 2,
                'created_at' => '2020-02-02 02:01:01',
                'updated_at' => '2020-02-02 02:01:01',
                'description' => '
Sent automatically to a third-party fulfillment service provider when order items are fulfilled.',
                'content' => 'This is the default message and should be edited forFulfilment request',
            ),
            13 => 
            array (
                'id' => 36,
                'name' => 'Shipping confirmation',
                'store_notification_category_id' => 2,
                'created_at' => '2020-02-02 02:01:01',
                'updated_at' => '2020-02-02 02:01:01',
            'description' => 'Sent automatically to the customer when their order is fulfilled (if you select this option).',
                'content' => 'This is the default message and should be edited forShipping confirmation',
            ),
            14 => 
            array (
                'id' => 37,
                'name' => 'Shipping update',
                'store_notification_category_id' => 2,
                'created_at' => '2020-02-02 02:01:01',
                'updated_at' => '2020-02-02 02:01:01',
            'description' => 'Sent automatically to the customer if their fulfilled order’s tracking number is updated (if you select this option).',
                'content' => 'This is the default message and should be edited forShipping update',
            ),
            15 => 
            array (
                'id' => 38,
                'name' => 'Out of delivery',
                'store_notification_category_id' => 2,
                'created_at' => '2020-02-02 02:01:01',
                'updated_at' => '2020-02-02 02:01:01',
            'description' => 'Sent automatically to the customer if their fulfilled order’s tracking number is updated (if you select this option).',
                'content' => 'This is the default message and should be edited forOut of delivery',
            ),
            16 => 
            array (
                'id' => 39,
                'name' => 'Delivered',
                'store_notification_category_id' => 2,
                'created_at' => '2020-02-02 02:01:01',
                'updated_at' => '2020-02-02 02:01:01',
                'description' => 'Sent to the customer automatically after orders with tracking information are delivered.',
                'content' => 'This is the default message and should be edited forDelivered',
            ),
            17 => 
            array (
                'id' => 40,
                'name' => 'Out of delivery',
                'store_notification_category_id' => 3,
                'created_at' => '2020-02-02 02:01:01',
                'updated_at' => '2020-02-02 02:01:01',
                'description' => 'Sent to the customer when their local order is out for delivery.',
                'content' => 'This is the default message and should be edited forOut of delivery',
            ),
            18 => 
            array (
                'id' => 41,
                'name' => 'Delivered',
                'store_notification_category_id' => 3,
                'created_at' => '2020-02-02 02:01:01',
                'updated_at' => '2020-02-02 02:01:01',
                'description' => 'Sent to the customer when their local order is delivered.',
                'content' => 'This is the default message and should be edited forDelivered',
            ),
            19 => 
            array (
                'id' => 42,
                'name' => 'Missed delivery',
                'store_notification_category_id' => 3,
                'created_at' => '2020-02-02 02:01:01',
                'updated_at' => '2020-02-02 02:01:01',
                'description' => 'Sent to the customer when they miss a local delivery.',
                'content' => 'This is the default message and should be edited forMissed delivery',
            ),
            20 => 
            array (
                'id' => 43,
                'name' => 'Ready for pickup',
                'store_notification_category_id' => 4,
                'created_at' => '2020-02-02 02:01:01',
                'updated_at' => '2020-02-02 02:01:01',
                'description' => 'Sent to the customer manually through Point of Sale or admin. Lets the customer know their order is ready to be picked up.',
                'content' => 'This is the default message and should be edited forReady for pickup',
            ),
            21 => 
            array (
                'id' => 44,
                'name' => 'Picked up',
                'store_notification_category_id' => 4,
                'created_at' => '2020-02-02 02:01:01',
                'updated_at' => '2020-02-02 02:01:01',
                'description' => '
Sent to the customer when the order is marked as picked up.',
                'content' => 'This is the default message and should be edited forPicked up',
            ),
            22 => 
            array (
                'id' => 45,
                'name' => 'Customer account invite',
                'store_notification_category_id' => 5,
                'created_at' => '2020-02-02 02:01:01',
                'updated_at' => '2020-02-02 02:01:01',
                'description' => '
Sent to the customer with account activation instructions. You can edit this email before you send it.',
                'content' => 'This is the default message and should be edited forCustomer account invite',
            ),
            23 => 
            array (
                'id' => 46,
                'name' => 'Customer account welcome',
                'store_notification_category_id' => 5,
                'created_at' => '2020-02-02 02:01:01',
                'updated_at' => '2020-02-02 02:01:01',
                'description' => 'Sent automatically to the customer when they complete their account activation.',
                'content' => 'This is the default message and should be edited forCustomer account welcome',
            ),
            24 => 
            array (
                'id' => 47,
                'name' => 'Customer account password reset',
                'store_notification_category_id' => 5,
                'created_at' => '2020-02-02 02:01:01',
                'updated_at' => '2020-02-02 02:01:01',
                'description' => 'Sent automatically to the customer when they ask to reset their accounts password.',
                'content' => 'This is the default message and should be edited forCustomer account password reset',
            ),
            25 => 
            array (
                'id' => 48,
                'name' => 'Contact Customer',
                'store_notification_category_id' => 5,
                'created_at' => '2020-02-02 02:01:01',
                'updated_at' => '2020-02-02 02:01:01',
                'description' => '
Sent to the customer when you contact them from the orders or customers page. You can edit this email before you send it.',
                'content' => 'This is the default message and should be edited forContact Customer',
            ),
            26 => 
            array (
                'id' => 49,
                'name' => 'Confirmation email',
                'store_notification_category_id' => 6,
                'created_at' => '2020-02-02 02:01:01',
                'updated_at' => '2020-02-02 02:01:01',
                'description' => '
Sent to the customer automatically when they sign up for email marketing (if email double opt-in is enabled).',
                'content' => 'This is the default message and should be edited forConfirmation email',
            ),
            27 => 
            array (
                'id' => 50,
                'name' => 'Return instructions',
                'store_notification_category_id' => 7,
                'created_at' => '2020-02-02 02:01:01',
                'updated_at' => '2020-02-02 02:01:01',
                'description' => 'Sent automatically to the customer when you create a return. Includes instructions as well as a return label, if applicable',
                'content' => 'This is the default message and should be edited forReturn instructions',
            ),
            28 => 
            array (
                'id' => 51,
                'name' => 'Return label instructions',
                'store_notification_category_id' => 7,
                'created_at' => '2020-02-02 02:01:01',
                'updated_at' => '2020-02-02 02:01:01',
                'description' => '
Sent to the customer after creating a return label.',
                'content' => 'This is the default message and should be edited forReturn label instructions',
            ),
        ));
        
        
    }
}