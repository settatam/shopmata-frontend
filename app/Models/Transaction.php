<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;


class Transaction extends Model
{
    use HasFactory, SoftDeletes;
    protected $filters = null;
    protected $input = [];

    protected $fillable = [
        'id',
        'status_id'
    ];

    protected static function booted()
    {
        static::updated(function ($transaction) {
            //
            $obj = new static;
            foreach($obj->input as $index => $input) {
                if(!in_array($index, $obj->fillable)) continue;
                if($checkForEvent = EventCondition::check(get_class(), $index, $input, 'updated')) {
                    dd($checkForEvent);
                }
            }
        });
    }

    public function setFilters($filters) {
        $this->filters = $filters;
    }

    static function search($filter) {
        return self::query()->withDates($filter)
            ->withCustomer($filter)
            ->withTransactionCount($filter)
            ->withLead($filter)
            ->withStore($filter)
            ->withDayOfWeek($filter)
            ->withTrafficSource($filter)
            ->with('offers')
            ->orderBy('id', 'desc')
            ->take(20)
            ->get();
    }

    public function scopeWithStore($query, $filter) {
        if($store_id = data_get($filter, 'store_id')) {
            $query->where('store_id', $store_id);
        }
    }

    public function scopeWithTransactionCount($query, $filter=null) {
        $query->selectRaw("transactions.*, COUNT(customer_id) AS `numberOfTransactions`")->groupBy('customer_id');
        if($repeat = data_get($filter, 'repeat')) {
            $query->havingRaw('numberOfTransactions > ?', [1]);
        }
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
        if($leads = data_get($filter, 'lead')) {
            if(!is_array($leads)) $leads = [$leads];
            $query->whereIn('lead_id', $leads);
        }
    }

    public function scopeWithTrafficSource($query, $filter=null)
    {
        if($sources = data_get($filter, 'source')) {
            if(!is_array($sources)) $sources = explode(',', $sources);
            $query->whereHas('trafficSource', function($q) use ($sources) {
                $q->whereIn('source', $sources);
            });
        }
    }


    public function scopeWithCustomer($query, $filter=null)
    {
        $query->whereHas('customer', function($q) use ($filter) {
             if($gender = data_get($filter, 'gender')) {
                 $q->where('gender', $gender);
             }

             if($state = data_get($filter, 'state')) {
                 $q->where('state', $state);
             }

        })->with('customer');
    }

    public function scopeWithDayOfWeek($query, $filter=null) {
        if($dayOfWeek = data_get($filter, 'dayOfWeek')) {
            $query->whereRaw("DAYNAME(created_at) = ?", [$dayOfWeek]);
        }
    }

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
    	return $this->belongsTo(Customer::class,'customer_id','id');
    }


    public function getCreatedAtAttribute($value)
    {
    	return \Carbon\Carbon::parse($value)->diffForHumans();
	}


    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function trafficSource() {
        return $this->belongsTo(SeoTraffic::class, 'seo_traffic_id', 'id');
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

    public function doUpdate($input) {
        $this->input = $input;
        //Get the current difference between the model and the input
        $inputCollection = collect($this->input);
        $collectionDifference = $inputCollection->diff($this);
        if($collectionDifference->count()) {
            //convert back to an array
            $this->input = $collectionDifference->toArray();
            if($this->update($this->input)) {
                //Log the update
                foreach($this->input as $index => $input) {
//                    if(!in_array($index, $this->fillable)) continue;
                    if($checkForEvent = EventCondition::check(get_class(), $index, $input, 'updated')) {
                        dd($checkForEvent);
                    }else{
                        dd('No UPdate');
                    }
                }
                return $this;
            }else{
                //Log Failure
            }
        }
        return $this;
    }
}
