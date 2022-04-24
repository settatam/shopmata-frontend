<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionOffer extends Model
{
    use HasFactory;

    const PRELIMINARY_OFFER = 'PRELIMINARY_OFFER';
    const FINAL_OFFER = 'FINAL_OFFER';
    const SECOND_OFFER = 'SECOND_OFFER';

    const OFFER_STATUS_SENT = 'sent';
    const OFFER_STATUS_ACCEPTED = 'accepted';
    const OFFER_STATUS_DECLINED = 'declined';

    protected $fillable = [
        'offer',
        'type',
        'status'
    ];

    public function transaction() {
        return $this->belongsTo(Transaction::class);
    }
}
