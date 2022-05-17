<?php

namespace App\Models;

use App\Services\EventNotification;
use App\Services\Logistics\Fedex;
use App\Services\Logistics\Shipping;
use App\Services\SmsManager;
use App\Widget\TransactionsTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Auth;


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
        'kit_type',
        'est_profit'
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

    public static function addtag($tag_id, $id) {

        $transaction = self::findOrFail($id);
        //This will become a problem if we don't have a store ....
        $store_tag   =  StoreTag::where(
                            [
                                'tagable_id' => $id,
                                'tag_id'     => $tag_id
                            ]
                        )->first();
        if (null !== $store_tag){
            $store_tag->delete();
            Log::info("Tag(s) deleted!", );
            return true;
        } else {
            $tags  = new StoreTag(['tag_id' => $tag_id]);
            if ( $transaction->tags()->save($tags) ) {
                return true;
            }
        }

        return false;
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
            ->withDaysInStock()
            ->withDates($filter)
            ->withStatus($filter)
            ->withCustomer($filter)
            ->withTransactionCount($filter)
            ->withLead($filter)
            ->withStores($filter)
            ->withDayOfWeek($filter)
            ->withTrafficSource($filter)
           // ->with('offers')
            ->orderBy('id', 'desc');
    }

    public function scopeWithDaysInStock($query) {
        return $query->selectRaw("DATEDIFF(NOW(), created_at)AS dis");
    }

    function stuff() {
        $q = "SELECT counter,val FROM (
			(SELECT 'kits_accepted' AS counter,count(*) AS val FROM orders WHERE date_shipment_received != 0 {$date_received}) UNION
			(SELECT 'kits_sent' AS counter,count(*) AS val FROM orders WHERE status_id > 0 {$dates}) UNION
			(SELECT 'kits_declined' AS counter,count(*) FROM orders WHERE date_offer_declined != 0 {$date_offer_paid} AND date_offer_accepted = 0) UNION
			(SELECT 'total_value' AS counter,round(sum(item_sum),2) FROM bmg_reporting WHERE date_offer_paid != 0 {$date_offer_paid}) UNION
			(SELECT 'kits_rejected' AS counter,count(*) FROM orders WHERE date_shipment_declined != 0 {$date_received}) UNION
			(SELECT 'kits_not_received' AS counter,count(*) FROM orders WHERE status_id <= 1 {$dates}) UNION
			(SELECT 'total_profit' AS counter,round(sum(profit_value),2) FROM orders WHERE date_offer_paid != 0 {$date_offer_paid}) UNION
			(SELECT 'sum_payout' AS counter,round(sum(offer_amount),2) AS val FROM orders WHERE date_offer_paid != 0 {$date_offer_paid}) UNION
			(SELECT 'estimated_value' AS counter,round(sum(item_sum),2) AS val FROM bmg_reporting WHERE 1 {$date_offer_paid}) UNION
			(SELECT 'sum_offer' AS counter,round(sum(offer_amount),2) AS val FROM orders WHERE date_offer_paid != 0 {$dates})
			) uxmegallc";
    }

//    public function scopeWithStatusDateTime($query) {
//        return $query->addSelect(['est_value'=>Acti::selectRaw('sum(price) as est_val')
//                ->whereColumn('transactions.id', 'transaction_items.transaction_id')
//        ]);
//    }

    public function scopeWithEstValue($query) {
        return $query->addSelect(['est_value'=>TransactionItem::selectRaw('sum(price) as est_val')
                ->whereColumn('transactions.id', 'transaction_items.transaction_id')
        ]);
    }

    public function scopeWithPaymentType($query) {
        return $query->addSelect(['transaction_payment_type'=>PaymentType::selectRaw('name as transaction_payment_type')
                ->whereColumn('transactions.payment_method_id', 'payment_types.id')
        ]);
    }

    public function scopeWithTotalDwt($query) {
        return $query->addSelect(['total_dwt'=>TransactionItem::selectRaw('sum(price) as total_dwt')
                ->whereColumn('transactions.id', 'transaction_items.transaction_id')
        ]);
    }

    public function scopeWithLabelsFrom($query) {
        return $query->addSelect(['outgoing_tracking'=>ShippingLabel::selectRaw('GROUP_CONCAT(tracking_number) as outgoing_tracking')
                ->whereColumn('transactions.id', 'shipping_labels.shippable_id')
                ->where('shipping_labels.to_customer', true)
        ]);
    }

    public function scopeWithStatusDateTime($query) {
        return $query->addSelect(['status_date_time'=>Activity::selectRaw("CONCAT(`status`, ' - ', DATE_FORMAT(created_at, '%m-%d-%Y %H:%i:%s')) as status_date_time")
                ->whereColumn('transactions.id', 'activities.activityable_id')
                ->where('is_status', true)
                ->take(1)->latest()
        ]);
    }

    public function scopeWithReceivedDateTime($query) {
        return $query->addSelect(['received_date_time'=>Activity::selectRaw("DATE_FORMAT(created_at, '%m-%d-%Y %H:%i:%s') as received_date_time")
                ->whereColumn('transactions.id', 'activities.activityable_id')
                ->where('status', 'Kit Received')
                ->take(1)
        ]);
    }

    public function scopeWithLabelsTo($query) {
        return $query->addSelect(['incoming_tracking'=>ShippingLabel::selectRaw('GROUP_CONCAT(tracking_number) as incoming_tracking')
                ->whereColumn('transactions.id', 'shipping_labels.shippable_id')
                ->where('shipping_labels.to_customer', false)
        ]);
    }

    public function scopeWithPublicNote($query) {
        return $query->addSelect(['public_note'=>TransactionNote::selectRaw('notes as public_note')
                ->whereColumn('transactions.id', 'transaction_notes.transaction_id')
                ->where('transaction_notes.type', 'public')
        ]);
    }

    public function scopeWithPrivateNote($query) {
        return $query->addSelect(['private_note'=>TransactionNote::selectRaw('notes as private_note')
                ->whereColumn('transactions.id', 'transaction_notes.transaction_id')
                ->where('transaction_notes.type', 'private')
        ]);
    }

    public function scopeWithFinalOffer($query) {
        return $query->addSelect(['offer'=>TransactionOffer::selectRaw('offer')
                ->whereColumn('transactions.id', 'transaction_offers.transaction_id')
                ->latest()->take(1)
        ]);
    }

    public function scopeWithStores($query, $filter) {
        if($stores = data_get($filter, 'stores')) {
            if(!is_array($stores)) $stores = [$stores];
            $query->whereIn('store_id', $stores);
        }
    }

    public function scopeWithStatus($query, $filter) {
        $status = data_get($filter, 'status');
        if(null !== $status) {
            if(!is_array($status)) $status = [$status];
            $query->whereIn('status_id', $status);
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

    public function scopeWithLeadSource($query) {
        return $query->addSelect(['lead_source'=>Lead::selectRaw('name as lead_source')
                ->whereColumn('transactions.lead_id', 'leads.id')
        ]);
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

             if($customer_id = data_get($filter, 'customer_id')) {
                 $q->where('id', $customer_id);
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

    static function tableData($filter, $data) {

        return (new TransactionsTable($filter, $data))->render();
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

    public function getCreatedDate($value)
    {
    	return \Carbon\Carbon::parse($value)->diffForHumans();
	}

    public function getEstProfitAttribute($value)
    {
//    	if($this->)
	}

//    public function getPrivateMessageAttribute($value)
//    {
//    	return optional($this->private_note)->notes;
//	}
//
//    public function getPublicMessageAttribute($value)
//    {
//    	return optional($this->public_note)->notes;
//	}

//    public function getEstValueAttribute() {
//        return $this->items->sum('price');
//    }

//    public function getTotalDwtAttribute() {
//        return $this->items->sum('dwt');
//    }

    public function getKitTypeAttribute() {
        return self::KIT_TYPE;
    }

//    public function getFinalOfferAttribute() {
//        return optional($this->offers()->orderBy('id', 'desc')->first())->offer;
//    }

//    public function getPaymentTypeAttribute() {
//        return optional($this->paymentTy)->name;
//    }

//    public function getEstimatedProfitAttribute() {
//        if($this->est_value && $this->final_offer) {
//            return round(($this->value - $this->final_offer), 2);
//        }
//        return '';
//    }

//    public function getStatusAttribute() {
//        return optional($this->trStatus)->name;
//    }

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

    public function transStatus() {
        return $this->belongsTo(Status::class, 'status_id', 'status_id');
    }

    public function trStatus() {
        return $this->belongsTo(Status::class, 'status_id', 'status_id');
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

    public function payment_address()
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
        $currentStatus = $this->trStatus->name;
        //Get the current difference between the model and the input
        $inputCollection = $this->input;
            //convert back to an array
            if($this->update($this->input)) {
                //Log the update
                foreach($this->getChanges() as $index => $input) {
                    //Create Activity Entry
                    $this->load('trStatus');
                    $status = optional($this->trStatus)->name;
                    if($index == 'updated_at') continue;
                    $this->activities()->create([
                        'user_id' => Auth::id(),
                        'agent' => Auth::user()->first_name,
                        'status' => $status,
                        'notes' => 'Updated status to ' . $status,
                        'name' => $currentStatus,
                        'is_status' => 1
                    ]);
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

    public function addOffer($amount) {
        if($this->offers()->create([
            'offer' => $amount
        ])) {
            $isSecondOffer = $this->offers()->count() > 1;
            if($isSecondOffer) {
                $this->doUpdate(['status_id'=>15]);
            }else{
                $this->doUpdate(['status_id'=>4]);
            }
            //Send Email about offer ...
        }
    }

    public function shippingAddress() {
        return $this->morphOne(Address::class, 'addressable');
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

    public function getShippingLabel($direction, $new=false) {
        if($direction != 'to' && $direction != 'from') return 'Direction must be to customer or from customer';
        switch ($direction) {
            case Shipping::SHIPPING_TYPE_TO:
                $labels = $this->shippingLabels()->where('to_customer', true)->latest()->first();
                break;
            case Shipping::SHIPPING_TYPE_FROM:
                $labels = $this->shippingLabels()->where('to_customer', false)->latest()->first();
                break;
        }

        if(null !== $labels) return $labels;

        if($shippingLabel = $this->createLabel($direction)) {
            if(!$shippingLabel->hasErrors()) {
                return $this->shippingLabels()->create([
                    'tracking_number' => $shippingLabel->getTrackingNumber(),
                    'raw_data' => $shippingLabel->getBase64Label(),
                    'to_customer' => $direction == Shipping::SHIPPING_TYPE_TO
                ]);
            }
        }

        return false;
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
            $shipperAddress = $this->shippingAddress;
            $recipientAddress = $this->store->shippingAddress;
        }else if($type == Shipping::SHIPPING_TYPE_TO) {
            $recipientAddress = $this->shippingAddress;
            $shipperAddress = $this->store->shippingAddress;
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
                    'color' => TransactionHistory::DECLINED_COLOR,
                    'name'=>'Item Returned',
                    'icon' => TransactionHistory::DECLINED_ICON,
                ];

            }else{

                $response['shipment_returned'] = [
                    'date' => '',
                    'color' => TransactionHistory::DECLINED_COLOR,
                    'icon' => TransactionHistory::DECLINED_ICON,
                    'name' => 'Item Returned'
                ];
            }
        }

        if($history = $this->hasHistory(TransactionHistory::OFFER_GIVEN)) {

            $response['offer_given']['date'] = $history->created_at;
            $response['offer_given']['icon'] = TransactionHistory::SUCCESS_ICON;
            $response['offer_given']['color'] = TransactionHistory::SUCCESS_COLOR;

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
                $response['offer_accepted'] = [
                    'date' => $history->created_at,
                    'name'=>'Offer Accepted',
                    'color' => TransactionHistory::SUCCESS_COLOR,
                    'icon' => TransactionHistory::SUCCESS_ICON,
                ];
            }
            if (!$this->hasHistory(TransactionHistory::OFFER_DECLINED)) {
                $response['offer_declined'] = [
                    'date' => $history->created_at,
                    'name'=>'Offer Declined',
                    'color' => TransactionHistory::DECLINED_ICON,
                    'icon' => TransactionHistory::DECLINED_COLOR,
                ];
            }

            if($history = $this->hasHistory(TransactionHistory::OFFER_PAID)) {
                $response['payment_processed'] = [
                    'date' => $history->created_at,
                    'name'=>'Payment Processed',
                    'color' => TransactionHistory::SUCCESS_COLOR,
                    'icon' => TransactionHistory::SUCCESS_ICON,
                ];
            }

            if($history = $this->hasHistory(TransactionHistory::OFFER_DECLINED)) {

                $response['offer_declined'] = [
                    'date' => $history->created_at,
                    'name'=>'Offer Declined',
                    'color' => TransactionHistory::DECLINED_COLOR,
                    'icon' => TransactionHistory::DECLINED_ICON,
                ];

                if($history = $this->hasHistory(TransactionHistory::SHIPMENT_RETURNED)) {
                    $response['shipment_returned'] = [
                        'date' => $history->created_at,
                        'name'=>'Shipment Returned',
                        'color' => TransactionHistory::DECLINED_COLOR,
                        'icon' => TransactionHistory::DECLINED_ICON,
                    ];
                }else{
                    $response['shipment_returned'] = [
                        'date' => '',
                        'name'=>'Shipment Returned',
                        'color' => TransactionHistory::OUTSTANDING_COLOR,
                        'icon' => TransactionHistory::OUTSTANDING_ICON,
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
        $smsMessage = new SmsManager();
        $to = $this->customer->phone_number;
        $from = $this->store->sms_send_from;
        $sender = $smsMessage->sendSMS($message, $to);
        if(!$sender['error']) {
            $data = [
                'message' => $message,
                'from' => $from,
                'to' => $to,
            ];
            $this->sms()->create($data);
        }else{
            //Insert to failed messages
            //Tag transaction
        }
    }




    public function createNote($type, $note=''){
        return TransactionNote::create([
            'type' => $type,
            'transaction_id' => $this->id,
            'notes' => $note
        ]);
    }

    public function sendMessageAndPictures() {

    }

}

