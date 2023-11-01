<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreActivity extends Model
{
    use HasFactory;

    protected $fillable = [
    	'user_id',
    	'activity',
    	'model',
    	'activity_id'
    ];

    const VENDOR_ASSIGNED = 'vendor_assigned';
    const VENDOR_UNASSIGNED = 'vendor_unassigned';
    const MEMO_CREATED = 'memo_created';
    const INTERNAL_NOTE_CREATED = 'internal_note_created';
    const EXTERNAL_NOTE_CREATED = 'external_note_created';
    const ITEM_ADDED = 'item_added';
}
