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

    const KIT_TYPE = 'Kit';

    protected $fillable = [
        'id',
        'status_id',
    ];

    protected $appends = [
        'est_value',
        'total_dwt',
        'final_offer',
        'payment_type',
        'lead',
        'status',
        'estimated_profit',
        'incoming_tracking',
        'outgoing_tracking',
        'kit_type'
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

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function setFilters($filters) {
        $this->filters = $filters;
    }

    static function search($filter) {
        return self::query()
            ->withDates($filter)
            ->withCustomer($filter)
            ->withTransactionCount($filter)
            ->withLead($filter)
            ->withStores($filter)
            ->withDayOfWeek($filter)
            ->withTrafficSource($filter)
            ->with('offers')
            ->orderBy('id', 'desc');
    }

    public function scopeWithStores($query, $filter) {
        if($stores = data_get($filter, 'stores')) {
            if(!is_array($stores)) $stores = [$stores];
            $query->whereIn('store_id', $stores);
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

    public function shippingLabel() {
        return $this->morphMany(ShippingLabel::class, 'shippable');
    }

    public function getIncomingTrackingAttribute() {
        return $this->shippingLabels()->where('to_customer', true)->get()
            ->implode('tracking_number', ',');
    }

    public function getOutgoingTrackingAttribute() {
        return $this->shippingLabels()->where('to_customer', false)->get()
            ->implode('tracking_number', ',');
    }


    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
	}


    public function public_note()
    {
        return $this->hasOne(TransactionNote::class)->where('type', TransactionNote::PUBLIC_TYPE);
    }


    public function private_note()
    {
        return $this->hasOne(TransactionNote::class)->where('type', TransactionNote::PRIVATE_TYPE);
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

    public function getEstValueAttribute() {
        return $this->items->sum('price');
    }

    public function getTotalDwtAttribute() {
        return $this->items->sum('dwt');
    }

    public function getKitTypeAttribute() {
        return self::KIT_TYPE;
    }

    public function getFinalOfferAttribute() {
        return optional($this->offers()->orderBy('id', 'desc')->first())->offer;
    }

    public function getPaymentTypeAttribute() {
        return optional($this->paymentTy)->name;
    }

    public function getEstimatedProfitAttribute() {
        if($this->est_value && $this->final_offer) {
            return round(($this->value - $this->final_offer), 2);
        }
        return '';
    }

    public function getStatusAttribute() {
        return optional($this->trStatus)->name;
    }

    public function getLeadAttribute() {
        return 'google';
//        return optional($this->trLead)->name;
    }

    public function paymentTy() {
        return $this->belongsTo(PaymentType::class, 'payment_method_id', 'id');
    }

    public function statuses() {
        return $this->store->transactionStatuses;
    }

    public function trStatus() {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    public function trLead() {
//        return $this->belongsTo(Lead::class, 'lead_id', 'id');
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

//    public function address() {
//        return $this->morphOne(Address::class, 'addressable');
//    }

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

    public function hasHistory($value) {
        return $this->histories()->where('event', $value)->first();
    }

    public function historyTimeline() {
        //Is updated
        $response = [
            'kit_requested' => [
                'date' => '',
                'name' => 'Kit Requested',
                'icon' => TransactionHistory::OUTSTANDING_ICON,
                'color' => 'black'
            ],
            'kit_sent' => [
                'date' => '',
                'name' => 'Kit Sent',
                'icon' => TransactionHistory::OUTSTANDING_ICON,
                'color' => 'black'
            ],
            'package_received' => [
                'date' => '',
                'name' => 'Package Received',
                'icon' => TransactionHistory::OUTSTANDING_ICON,
                'color' => 'black'
            ],
            'offer_given' => [
                'date' => '',
                'name' => 'Offer Given',
                'icon' => TransactionHistory::OUTSTANDING_ICON,
                'color' => 'black'
            ],
            'offer_accepted' => [
                'date' => '',
                'name' => 'Offer Accepted',
                'icon' => TransactionHistory::OUTSTANDING_ICON,
                'color' => 'black'
            ],
            'payment_processed' => [
                'date' => '',
                'name' => 'Payment Processed',
                'icon' => TransactionHistory::OUTSTANDING_ICON,
                'color' => 'black'
            ],
//            'shipment_declined' => [
//                'date' => '',
//                'name' => 'Shipment Declined',
//                'icon' => TransactionHistory::DECLINED_ICON,
//                'color' => 'red'
//            ],
//            'shipment_returned' => [
//                'date' => '',
//                'name' => 'Shipment Declined',
//                'icon' => TransactionHistory::DECLINED_ICON,
//                'color' => 'red'
//            ],
//            'offer_declined' => [
//                'date' => '',
//                'name' => 'Offer Declined',
//                'icon' => TransactionHistory::DECLINED_ICON,
//                'color' => 'red'
//            ],

        ];
        if($history = $this->hasHistory(TransactionHistory::UPDATED)) {
            $response['kit_requested']['date'] = $history->created_at;
            $response['kit_requested']['color'] = 'green';
            $response['kit_requested']['icon'] = TransactionHistory::SUCCESS_ICON;
        }

        if($history = $this->hasHistory(TransactionHistory::FULFILLED)) {
            $response['kit_sent']['date'] = $history->created_at;
            $response['kit_sent']['color'] = 'green';
            $response['kit_sent']['icon'] = TransactionHistory::SUCCESS_ICON;
        }

        if($history = $this->hasHistory(TransactionHistory::SHIPMENT_DECLINED)) {
            $response['shipment_declined'] = [
                'date' => $history->created_at,
                'icon' => 'XCircle',
                'name'=>'Shipment Rejected',
                'color' => 'red'
            ];

            if($history = $this->hasHistory(TransactionHistory::SHIPMENT_RETURNED)) {
                $response['shipment_returned'] = [
                    'date' => $history->created_at,
                    'success' =>1,
                    'default'=>1,
                    'name'=>'Item Returned',
                    'class'=>1
                ];
            }else{
                $response[] = [
                    'date' => '',
                    'success' =>0,
                    'default'=>1,
                    'name'=>'Item Returned',
                    'class'=>1
                ];
            }
        }

        if($history = $this->hasHistory(TransactionHistory::OFFER_GIVEN)) {

            $response['offer_given'] = [
                'date' => $history->created_at,
                'success' => 1,
                'default'=>1,
                'name'=>'Offer Given',
                'class'=>1
            ];

//            if(in_array('Offer #2 Given', $attributes)) {
//                    $response[] = [
//                    'date' => IO::formatDate(array_search('Offer #2 Given', $attributes)),
//                    'success' => 1,
//                    'default'=>1,
//                    'name'=>'Offer #2 Given',
//                    'class'=>1
//                ];
//            }

//            if(in_array('Offer Given (Cnotes & Picture)', $attributes)) {
//                    $response[] = [
//                    'date' => IO::formatDate(array_search('Offer Given (Cnotes & Picture)', $attributes)),
//                    'success' => 1,
//                    'default'=>1,
//                    'name'=>'Offer Given (Cnotes & Picture)',
//                    'class'=>1
//                ];
//            }

            if($history = $this->hasHistory(TransactionHistory::OFFER_ACCEPTED)) {
                $response[] = [
                    'date' => $history->created_at,
                    'success' => 1,
                    'default'=>1,
                    'name'=>'Offer Accepted',
                    'class'=>1,
                    'color' => 'green'
                ];
            }else{
                if (!$this->hasHistory(TransactionHistory::OFFER_DECLINED)) {
                    $response['offer_declined'] = [
                        'date' => '',
                    ];
                }
            }

            if($history = $this->hasHistory(TransactionHistory::OFFER_PAID)) {
                $response[] = [
                    'date' => $history->created_at,
                    'success' => 1,
                    'default'=>1,
                    'name'=>'Payment Sent',
                    'class'=>1
                ];
            }else{
//                $response[] = [
//                    'date' => '',
//                    'success' => 0,
//                    'default'=>1,
//                    'name'=>'Payment Processed',
//                    'class'=>1
//                ];
            }

            if($history = $this->hasHistory(TransactionHistory::OFFER_DECLINED)) {
                $response[] = [
                    'date' => $history->created_at,
                    'success' => 1,
                    'default'=>1,
                    'name'=>'Offer Declined',
                    'class' => 0,
                    'color' => 'red'
                ];

                if($history = $this->hasHistory(TransactionHistory::SHIPMENT_RETURNED)) {
                    $response[] = [
                        'date' => $history->created_at,
                        'success' =>1,
                        'default'=>1,
                        'name'=>'Item Returned',
                        'class'=>1
                    ];
                }else{
                    $response[] = [
                        'date' => '',
                        'success' =>0,
                        'default'=>1,
                        'name'=>'Item Returned',
                        'class'=>1
                    ];
                }
            }
        }

        if ($this->hasHistory(TransactionHistory::SHIPMENT_DECLINED) && $this->hasHistory(TransactionHistory::OFFER_GIVEN)) {
            $response[] = [
                'date' => '',
                'success' => 0,
                'default'=>1,
                'name'=>'Offer Given',
                'class'=>1
            ];

            $response[] = [
                'date' => '',
                'success' => 0,
                'default'=>1,
                'name'=>'Offer Accepted',
                'class'=>1
            ];

            $response[] = [
                    'date' => '',
                    'success' => 0,
                    'default'=>1,
                    'name'=>'Payment Processed',
                    'class'=>1
            ];
        }

        return array_values($response);
    }

    public function sendSMS($message) {

    }

    public function createNote($type, $note=''){
        return TransactionNote::create([
            'type' => $type,
            'transaction_id' => $this->id,
            'notes' => $note
        ]);
    }

}
