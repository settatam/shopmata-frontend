<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public $events = [
        'customer-created' => 'When a new customer is created',
        'customer-updated' => 'When a customer account details are updated',
        'customer-deleted' => 'When a customer account is deleted',
        'customer-invite' => 'When a customer is invited',
        'store-created' => 'When a store is created',
        'store-updated' => 'When store details is updated',
        'store-deleted' => 'When a store is deleted',
        'transaction-created' => 'When a buying transaction is created',
        'transaction-edited' => 'When is buying transaction is edited',
        'transaction-deleted' => 'When a buying transaction is deleted',
        'preliminary-offer-sent' => 'When a preliminary offer is sent',
        'final-offer-sent' => 'When a final offer has been sent',
        'payment-sent' => 'When a payment for a transaction has been sent',
        'offer-rejected' => 'When an offer is rejected',
        'fake-items' => 'When an item is deemed to be fake',
        'product-created' => 'When a new product is created',
        'product-edited' => 'When product is edited',
        'product-deleted' => 'When a product id deleted',
        'item-added-to-cart' => 'When an item is added to cart',
        'order-created' => 'When an order is created',
        'order-edited' => 'When an order is edited',
        'order-cancelled' => 'When an order is cancelled',
        'order-fulfilled' => 'when an order is fulfilled',
        'order-paid' => 'When an order has been paid',
        'order-refund' => 'When an order has been refunded',
        'gift-card-created' => 'When a gift card has been created',
        'payment-error' => 'When there is a payment error',
        'shipping-update' => 'When there is a shipping update',
        'abandoned-cart' => 'When there is an abandoned cart',
    ];
}
