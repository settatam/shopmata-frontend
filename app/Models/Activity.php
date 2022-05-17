<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    const TRANSACTION_UPDATE_STATUS = 'Status updated to ';
    const TRANSACTION_ADD_IMAGE = 'Added a new Image';
    const TRANSACTION_INBOUND_SHIPPING_LABEL = 'Printed Inbound shipping label';
    const TRANSACTION_OUTBOUND_SHIPPING_LABEL = 'Printed Outbound shipping label';
    const TRANSACTION_CREATE_BARCODE = 'Created a barcode';
    const TRANSACTION_ADD_PUBLIC_NOTE = 'Added a public note';
    const TRANSACTION_ADD_PRIVATE_NOTE = 'Added a private note';
    const TRANSACTION_MAKE_OFFER = 'Made an offer';
    const TRANSACTION_MAKE_SECOND_OFFER = 'Made a second offer';
    const TRANSACTION_ADD_TAG = 'Added a Tag';
    const TRANSACTION_NEW = 'New Kit';

    protected $fillable = [
        'id',
        'activityable_type',
        'activityable_id',
        'user_id',
        'agent',
        'store_id',
        'status',
        'offer',
        'notes',
        'name',
        'is_from_admin',
    ];


    public function activityable()
    {
        return $this->morphTo();
    }

}
