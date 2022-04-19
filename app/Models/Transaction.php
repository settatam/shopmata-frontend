<?php

namespace App\Models;

use App\Services\EventNotification;
use App\Services\Logistics\Fedex;
use App\Services\Logistics\Shipping;
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
        'status_id',

    ];

    protected static function booted()
    {
        static::updated(function ($transaction) {
            //
//            $obj = new static;
//            foreach($obj->input as $index => $input) {
//                if(!in_array($index, $obj->fillable)) continue;
//                if($checkForEvent = EventCondition::check(get_class(), $index, $input, 'updated')) {
//                    dd($checkForEvent);
//                }
//            }
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

    public function store() {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function doUpdate($input) {
        $this->input = $input;
        //Get the current difference between the model and the input
        $inputCollection = $this->input;
            //convert back to an array
            if($this->update($this->input)) {
                //Log the update
                foreach($this->getChanges() as $index => $input) {
                    $checkForEvent = EventCondition::check(get_class(), $index, $input, 'updated');
                    $checkForEvent = EventCondition::check(get_class(), TransactionOffer::class, TransactionOffer::FINAL_OFFER, 'added');
                    if(null !== $checkForEvent) {
                        if(null !== $checkForEvent->notification) {
                            $sendNotice = new EventNotification(
                                $checkForEvent->notification->name,
                                [
                                    'customer' => $this->customer,
                                    'store' => $this->store
                                ]
                            );
                        }
                    }
                }
            }else{
                //Log Failure
            }
        return $this;
    }

    public function shippingAddress() {
        return $this->hasOne(Address::class)->where('type', Address::SHIPPING_ADDRESS_TYPE);
    }

    public function shippingLabels() {
        return $this->morphMany(ShippingLabel::class, 'shippable');
    }

    public function shippingLabelFrom() {
        return $this->hasOne(ShippingLabel::class)->where('type', Shipping::SHIPPING_TYPE_FROM);
    }

    public function shippingLabelTo() {
        return $this->hasOne(ShippingLabel::class)->where('type',  Shipping::SHIPPING_TYPE_TO);
    }

    public function getOrSetShippingLabel($type, $cache=false) {

    }

    public function generateBarcode(){

    }

    public function createLabel($type)
    {
        $shipperAddress = null;
        $recipientAddress = null;
        //Check to see if both shipping addresses exist
        if ($type == Shipping::SHIPPING_TYPE_FROM){
            $shipperAddress = $this->customer->shippingAddress();
            $recipientAddress = $this->store->shippingAddress();
        }else if($type == Shipping::SHIPPING_TYPE_TO) {
            $shipperAddress = $this->customer->shippingAddress();
            $recipientAddress = $this->store->shippingAddress();
        }

        if(null !== $shipperAddress && null !== $recipientAddress) {
            $fedex = new Fedex();
            $fedex->setShipper($shipperAddress);
            $fedex->setRecipient($recipientAddress);

            //We can set weight, amount and all the other properties ...
            try{
                $fedexLabel =  $fedex->getLabel();
                return $fedexLabel;
            }catch (\Exception $e) {
                dd($e->getMessage());
            }
        }

        return false;
    }
}
