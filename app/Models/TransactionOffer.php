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

    protected $fillable = [
        'offer',
        'type'
    ];

    public function transaction() {
        return $this->belongsTo(Transaction::class);
    }
}
