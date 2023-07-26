<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionTracking extends Model
{
    use HasFactory;

    protected $fillable = [
      'content',
      'step'
    ];

    protected $appends = [
      'tracking_id'
    ];

    public function getContentAttribute($value)
    {
      if ($value) {
        $newValue = unserialize($value);
        unset($newValue['tracking_id']);
        return $newValue;
      }
      return '';
    }

    public function getTrackingIdAttribute()
    {
      return $this->id;
    }
}
