<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

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
        'is_status'
    ];

    public function activityable()
    {
        return $this->morphTo();
    }

    static function generateNote($current, $changes, $model) {
        $user = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        $note = 'updated the ' . $model . 'with the following;';
        $changeText = '';

        foreach($changes as $index => $change) {
            if($index == 'updated_at') continue;
            $changedTo = $current->{$index};
            if($index == 'status_id') {
                $change    = Status::findById($change);
                $changedTo = Status::findById($current->{$index});
                $index = 'status';
            }

            $changeText .= $index .' : ' . $changedTo . ' => ' . $change;
        }

        return sprintf('%s updated the %s with the following: %s',
            $user,
            $model,
            $changeText
        );
    }

    static function addNew(Transaction $current, $changes, $model, $note='') {

        if(empty($note)) {
            $note = self::generateNote($current, $changes, $model);
        }

        $isStatus = false;
        $status = Status::findById($current->status_id);

        if(array_key_exists('status_id', $changes)) {
            $isStatus = true;
            $status = Status::findById($changes['status_id']);
        }

        return self::create([
            'user_id' => Auth::id(),
            'agent' => Auth::user()->first_name,
            'status' => $status,
            'notes' => $note,
            'name' => Status::findById($current->status_id),
            'is_status' => $isStatus,
            'activityable_id' => $current->id,
            'activityable_type' => get_class($current)
        ]);
    }

}
