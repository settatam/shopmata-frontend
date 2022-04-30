<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'event',
        'created_at'
    ];

    const UPDATED = 'UPDATED';
    const FULFILLED = 'FULFILLED';
    const KIT_DENIED = 'KIT DENIED';
    const SHIPMENT_RECEIVED = 'SHIPMENT RECEIVED';
    const SHIPMENT_DECLINED = 'SHIPMENT DECLINED';
    const SHIPMENT_RETURNED = 'SHIPMENT RETURNED';
    const OFFER_GIVEN = 'OFFER GIVEN';
    const PACKAGE_RECEIVED = 'PACKAGE RECEIVED';
    const OFFER_ACCEPTED = 'OFFER ACCEPTED';
    const OFFER_DECLINED = 'OFFER DECLINED';
    const OFFER_PAID = 'OFFER PAID';
    const OFFER_2_GIVEN = 'OFFER #2 GIVEN';
    const EMAIL_NOTES_PICTURES = 'EMAIL, NOTES AND PICTURES';
    const EMAIL_NOTES_PICTURES_OFFER = 'EMAIL, NOTES, PICTURES AND OFFER';
    const SUCCESS_ICON = 'CheckCircleIcon';
    const DECLINED_ICON = 'XCircleIcon';
    const OUTSTANDING_ICON = 'MinusCircleIcon';
    const SUCCESS_COLOR = 'CheckCircleIcon';
    const DECLINED_COLOR = 'XCircleIcon';
    const OUTSTANDING_COLOR = 'MinusCircleIcon';
}


