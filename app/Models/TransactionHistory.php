<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHistory extends Model
{
    use HasFactory;

    const UPDATED = 'UPDATED';
    const FULFILLED = 'FULFILLED';
    const KIT_DENIED = 'KIT DENIED';
    const SHIPMENT_RECEIVED = 'SHIPMENT RECEIVED';
    const SHIPMENT_DECLINED = 'SHIPMENT DECLINED';
    const SHIPMENT_RETURNED = 'SHIPMENT RETURNED';
    const OFFER_GIVEN = 'OFFER GIVEN';
    const OFFER_ACCEPTED = 'OFFER ACCEPTED';
    const OFFER_DECLINED = 'OFFER DECLINED';
    const OFFER_PAID = 'OFFER PAID';

}
