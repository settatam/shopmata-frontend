<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
    ];

    static function search($filter) {
        return self::withDates($filter)
            ->withCustomer($filter)
            ->isRepeatCustomer($filter)
            ->withLead($filter)
            ->with('offers')
            ->orderBy('id', 'desc')
            ->take(20)
            ->get();
    }

    public function scopeWithDates($query, $filter=null)
    {
        if($dates = data_get($filter, 'dates')) {
            $query->whereBetween('created_at', [
                [
                    data_get($dates, 'from'),
                    data_get($dates, 'to'),
                ]
            ]);
        }
    }

    public function scopeWithLead($query, $filter=null)
    {
        if($lead = data_get($filter, 'lead')) {
            $query->where('lead_id', $lead);
        }
    }

    public function scopeIsRepeatCustomer($query, $filter)
    {
        if($repeat = data_get($filter, 'repeat')) {
            $query->groupBy('customer_id')->havingRaw('COUNT(*) > 1');
        }
    }

    public function scopeWithCustomer($query, $filter)
    {
        $query->whereHas('customer', function($q) use ($filter) {
             if($gender = data_get($filter, 'gender')) {
                 $q->where('gender', $gender);
             }

        })->with('customer');
    }

//    public function scopeWithCustomer($query, )


    public function activities()
    {
        return $this->morphMany(Activity::class, 'activityable');
	}


    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
	}


    public function notes()
    {
        return $this->hasMany(TransactionNote::class);
    }


    public function customer()
    {
    	return $this->belongsTo(Customer::class);
    }


    public function getCreatedAtAttribute($value)
    {
    	return \Carbon\Carbon::parse($value)->diffForHumans();
	}


    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }


    public function histories()
    {
        return $this->hasMany(TransactionHistory::class);
    }


    public function offers()
    {
        return $this->hasMany(TransactionOffer::class);
    }


    public function transaction_payment_address()
    {
        return $this->hasOne(TransactionPaymentAddress::class);
    }


    public function sms()
    {
        return $this->morphMany(Sms::class, 'smsable');
    }


    public function tags()
    {
        return $this->morphMany(StoreTag::class, 'tagable');
    }

    public function getCustomerNameAttribute() {
//        return $this->customer->first_name  . ' ' . $this->customer->last_name;
    }
}
