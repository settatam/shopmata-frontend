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
use Numeral\Numeral;


class Transaction extends Model
{
    use HasFactory, SoftDeletes;
    protected $filters = null;
    protected $input = [];

    const KIT_TYPE = 'Kit';
    const FIRST_OFFER_NOTIFICATION_NAME = 'First Offer';
    const OTHER_OFFER_NOTIFICATION_NAME = 'Other Offer';
    const PENDING_KIT_ID = 60;

    protected $fillable = [
        'id',
        'status_id',
        'customer_id',
        'bin_location'
    ];

    protected $appends = [
        'kit_type',
        'est_profit',
        'created_date',
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

    public static function addtag($tag_id, $id) { #why is this a static function? This is a perrc

        $transaction = self::findOrFail($id);
        //This will become a problem if we don't have a store ....
        $store_tag   =  StoreTag::where([ 'tagable_id' => $id, 'tag_id' => $tag_id])->first();
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
            ->withTerm($filter)
            ->withLead($filter)
            ->withStores($filter)
            ->withDayOfWeek($filter)
            ->withTrafficSource($filter)
            ->with('offers')
            ->withLabelsFrom($filter)
            ->withTransactions($filter)
            ->withLabelsTo($filter)
            ->orderBy('transactions.id', 'desc');
    }

    static function searchForFilter($filter) {
        return self::query()
            ->withTrafficSource($filter)
            ->withLead($filter)
            ->withStores($filter)
            ->withDayOfWeek($filter);
    }

    public function scopeWithTerm($query, $filter) {
        if($term = data_get($filter, 'term')) {
            $query->where('id', 'LIKE', '%'.$term.'%');
            $query->orWhereHas('customer', function($q) use ($term){
                $q->where('first_name', 'LIKE', '%'.$term.'%')
                ->orWhere('last_name', 'LIKE', '%'.$term.'%');
            });
        }
    }

    public function scopeWithTotalBought() {

    }

    public function scopeWithDaysInStock($query) {
        return $query->selectRaw("DATEDIFF(NOW(), created_at) AS dis");
    }

    public function scopeWithGroupedStatus($query) {
       return $query->selectRaw("status_id, COUNT(status_id) AS `statusCount`")
           ->groupBy('status_id');
    }

    public function scopeWithGroupedDates($query) {
        return $query->selectRaw('DATE_FORMAT(created_at, "%W") as day,  COUNT(DATE_FORMAT(created_at, "%W")) AS `dayCount`')
        ->groupBy('day');
    }

    public function scopeWithGroupedGender($query) {
        $query->join('customers', 'customers.id', '=', 'transactions.customer_id')
              ->where('gender', '!=', null)
            ->selectRaw("gender, COUNT(gender) AS `genderCount`")->groupBy('gender');
    }

    public function scopeWithGroupedStates($query) {
        $query->join('addresses', 'addresses.addressable_id', '=', 'transactions.id')
            ->join('states', 'addresses.state_id', '=', 'states.id')
            ->selectRaw("states.name, addresses.state_id, COUNT(addresses.state_id) AS `stateCount`")->groupBy('state_id');
    }

    public function scopeWithGroupedPaymentTypes($query) {
        $query->join('transaction_payment_addresses', 'transaction_payment_addresses.transaction_id', '=', 'transactions.id')
            ->join('transaction_payment_types', 'transaction_payment_addresses.payment_type_id', '=', 'transaction_payment_types.id')

            ->selectRaw("transaction_payment_types.name, transaction_payment_addresses.payment_type_id, COUNT(transaction_payment_addresses.payment_type_id) AS `paymentCount`")->groupBy('payment_type_id');
    }


    public function scopeWithGroupedLeads($query) {
        $query->join('customers', 'customers.id', '=', 'transactions.customer_id')
                ->join('leads', 'customers.lead_id', '=', 'leads.id')
               ->selectRaw("leads.name, customers.lead_id, COUNT(customers.lead_id) AS `leadIdCount`")->groupBy('lead_id');
    }

    public function scopeWithGroupedRepeatCustomer($query, $repeat=true) {
        $query->selectRaw("COUNT(customer_id) AS `numberOfTransactions`")->groupBy('customer_id');
        if($repeat) {
            $query->havingRaw('numberOfTransactions > ?', [1]);
        }else{
            $query->havingRaw('numberOfTransactions = ?', [1]);
        }
    }


//    public function scopeWithStatusDateTime($query) {
//        return $query->addSelect(['est_value'=>Acti::selectRaw('sum(price) as est_val')
//                ->whereColumn('transactions.id', 'transaction_items.transaction_id')
//        ]);EstPri
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
        return $query->addSelect(['total_dwt'=>TransactionItem::selectRaw('sum(dwt) as total_dwt')
                ->whereColumn('transactions.id', 'transaction_items.transaction_id')
        ]);
    }

    public function scopeWithLabelsTo($query) {
        return $query->addSelect(['outgoing_tracking'=>ShippingLabel::selectRaw('GROUP_CONCAT(tracking_number) as outgoing_tracking')
                ->whereColumn('transactions.id', 'shipping_labels.shippable_id')
                ->where('shipping_labels.to_customer', true)
                ->where('shipping_labels.is_return', 0)
        ]);
    }

    public function scopeWithReturnLabel($query) {
        return $query->addSelect(['return_tracking'=>ShippingLabel::selectRaw('GROUP_CONCAT(tracking_number) as return_tracking')
                ->whereColumn('transactions.id', 'shipping_labels.shippable_id')
                ->where('shipping_labels.is_return', 1)
               ->take(1)->latest()
        ]);
    }

    public function scopeWithLabelsFrom($query) {
        return $query->addSelect(['incoming_tracking'=>ShippingLabel::selectRaw('GROUP_CONCAT(tracking_number) as incoming_tracking')
                ->whereColumn('transactions.id', 'shipping_labels.shippable_id')
                ->where('shipping_labels.to_customer', false)
                ->where('shipping_labels.is_return', false)
                ->take(1)->latest()
        ]);
    }

    public function scopeWithStatusDateTime($query) {
        return $query->addSelect(['status_date_time'=>Activity::selectRaw("CONCAT(`status`, ' - ', DATE_FORMAT(created_at, '%m-%d-%Y %H:%i:%s')) as status_date_time")
                ->whereColumn('transactions.id', 'activities.activityable_id')
                ->where('is_status', true)
                ->take(1)->latest()
        ]);
    }

    public function scopeWithPaymentDateTime($query) {
        return $query->addSelect(['payment_date_time'=>Activity::selectRaw("DATE_FORMAT(created_at, '%m-%d-%Y %H:%i:%s') as payment_date_time")
                ->whereColumn('transactions.id', 'activities.activityable_id')
                ->where('status', 'Payment Processed')
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

    public function scopeWithPublicNote($query) {
        return $query->addSelect(['pub_note'=>TransactionNote::selectRaw('notes as pub_note')
                ->whereColumn('transactions.id', 'transaction_notes.transaction_id')
                ->where('transaction_notes.type', 'public')
                ->take(1)->latest()
        ]);
    }

    public function getProfitPercent($offer, $est_val) {
        if(isset($est_val) && isset($offer)) {
            $result = ($offer - $est_val) / 100;
            return Numeral::number($result)->format('0.0%');
        }
        return null;
    }

    public function scopeWithPrivateNote($query) {
        return $query->addSelect(['private_note'=>TransactionNote::selectRaw('notes as private_note')
                ->whereColumn('transactions.id', 'transaction_notes.transaction_id')
                ->where('transaction_notes.type', 'private')
                ->latest()->take(1)
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

    public function scopeWithTransactions($query) {
        $query->selectRaw('transactions.*');
    }

    public function scopeWithTransactionCount($query, $filter=null) {
        $query->join('transactions as t', 'transactions.id', '=', 't.id')
            ->selectRaw('COUNT(t.id) AS numberOfTransactions')
            ->whereRaw('t.customer_id = transactions.customer_id');

        if($repeat = data_get($filter, 'repeat')) {
            $query->havingRaw('numberOfTransactions > ?', [1]);
        }
        //$query->where('transactions.customer_id', 't.customer_id');
    }

    public function scopeWithTransactionCountss($query, $filter=null) {
        $query->selectRaw("COUNT(customer_id) AS `numberOfTransactions`");
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
            //$query->whereIn('lead_id', $leads);
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


    public function publicnote()
    {
        return $this->hasOne(TransactionNote::class)->where('type', TransactionNote::PUBLIC_TYPE);
    }


    public function privatenote()
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

    public function getCreatedDateAttribute($value)
    {
    	return \Carbon\Carbon::parse($this->created_at)->format('m-d-Y h:i A');
	}

    public function getEstProfitAttribute($value)
    {
    	if($this->est_value && $this->offer) {
            return Numeral::number($this->offer - $this->est_value)->format('$0,0');
        }
	}

    public function getPercentageProfitAttribute(){
        if($this->est_value && $this->offer) {
            return $this->getProfitPercent($this->offer, $this->est_value);
        }

        return null;
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

    public function allTags() {
        $set = '';
        $x     = 1;
        if (null != $this->tags) {
            foreach($this->tags as $tag){
                $set .= " {$tag->tag->name} ";
                if($x < $this->tags->count()){
                    $set .= ', ';
                }
                $x++;
            }
        }
       
        return $set;
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

    public function transStatus() {
        return $this->belongsTo(Status::class, 'status_id', 'id');
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

    public function payment()
    {
        return $this->hasOne(TransactionHistory::class)->where('event', TransactionHistory::OFFER_PAID);
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
        $currentObj = clone $this;
        //Get the current difference between the model and the input
        $inputCollection = $this->input;
            //convert back to an array
            if($this->update($this->input)) {
                //Log the update
                $changes = $this->getChanges();
                if(count($changes)) {
                    $dd = $this->addActivity($currentObj, $changes);
                }
                $this->load('trStatus');
                foreach($this->getChanges() as $index => $input) {
                    //Create Activity Entry
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

    public function addActivity($transaction, $changes, $note='') {
        $this->load('trStatus');
        return Activity::addNew($transaction, $changes, 'transaction', $note);
    }

    public function addOffer($amount) {
        $notification_name = '';
        if($this->offers()->create([
            'offer' => $amount
        ])) {

            $isSecondOffer = $this->offers()->count() > 1;
            if($isSecondOffer) {
                $this->doUpdate(['status_id'=>15]);
                $offerNote = Activity::TRANSACTION_MAKE_SECOND_OFFER;
                $notification_name = self::OTHER_OFFER_NOTIFICATION_NAME;
            }else{
                $this->doUpdate(['status_id'=>4]);
                $offerNote = Activity::TRANSACTION_MAKE_OFFER;
                $notification_name = self::OTHER_OFFER_NOTIFICATION_NAME;
            }

            $note = sprintf('%s %s %s',
                Auth::user()->full_name,
                $offerNote,
                Numeral::number($amount)->format('$0.0')
            );

            $this->addActivity($this, [], $note);


            //Send Email about offer ...
        }
    }

    public function sendOffer(){
        $notification_name = '';
        return new EventNotification(
            $notification_name,
            [
                'customer' => $this->customer,
                'store' => $this->store,
                'transaction' => $this
            ]
        );
    }

    public function sendNotes() {
        $notification_name = '';
        return new EventNotification(
            'Transaction Customer Notes',
            [
                'customer' => $this->customer,
                'store' => $this->store,
                'transaction' => $this,
            ]
        );
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

    public function getShippingLabel($direction, $is_return=false) {
        if($direction != 'to' && $direction != 'from') return 'Direction must be to customer or from customer';
        if($is_return) {
            $labels = $this->shippingLabels()->where('to_customer', true)->where('is_return', true)->latest()->first();
        }else{
            switch ($direction) {
            case Shipping::SHIPPING_TYPE_TO:
                $labels = $this->shippingLabels()->where('to_customer', true)->where('is_return', false)->latest()->first();
                break;
            case Shipping::SHIPPING_TYPE_FROM:
                $labels = $this->shippingLabels()->where('to_customer', false)->latest()->first();
                break;
            }
        }

        if(null !== $labels) return $labels;



        if($shippingLabel = $this->createLabel($direction)) {
            if(!$shippingLabel->hasErrors()) {
                if($label = $this->shippingLabels()->create([
                    'tracking_number' => $shippingLabel->getTrackingNumber(),
                    'raw_data' => $shippingLabel->getBase64Label(),
                    'to_customer' => $direction == Shipping::SHIPPING_TYPE_TO,
                    'is_return' => (bool)$is_return
                ])) {

                    $labelType = ($is_return) ? ' return ' : '';
                    $note = sprintf(
                        '%s created a new %s shipping label %s with tracking number %s',
                        Auth::user()->full_name,
                        $labelType,
                        $direction,
                        $shippingLabel->getTrackingNumber()
                    );

                    $this->addActivity($this, [], $note);
                    return $label;
                }
            }

            dd($shippingLabel);
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
            $shipperAddress = $this->customer->address;
            $recipientAddress = $this->store->shippingAddress;
        }else if($type == Shipping::SHIPPING_TYPE_TO) {
            $recipientAddress = $this->customer->address;
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
               // dd($e->getMessage());
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

    public function createNote($type, $message=''){

       if($notes = TransactionNote::create([
            'type' => $type,
            'transaction_id' => $this->id,
            'notes' => $message
        ])) {
           $user = Auth::user()->full_name;
           $text = $type === TransactionNote::PUBLIC_TYPE ? Activity::TRANSACTION_ADD_PUBLIC_NOTE : Activity::TRANSACTION_ADD_PRIVATE_NOTE;

           $note = sprintf('%s %s - %s',
            $user,
            $text,
            $message
           );


           $this->addActivity($this, [], $note);
       }
    }

    public function sendMessageAndPictures() {

    }

    public function createNewFromTransaction() {

        if($newKit = self::create([
            'customer_id' => $this->customer_id,
            'status_id' => self::PENDING_KIT_ID,
            'store_id' => $this->store->id
        ])) {
            $note = sprintf('%s created a new kit', Auth::user()->full_name);
            $newKit->addActivity($newKit, [], $note);
        }

        return $newKit;
    }

     public function getPublicNote() {
        $note = $this->publicnote()->latest()->first();

        if(null !== $note) {
            return $note;
        }
        return $this->publicnote()->create([
            'type' => 'public',
            'notes' => '',
        ]);
    }


    private function calcProfit($cost, $selling) {
        if(!$cost && !$selling) return '';
        $profit = $selling - $cost;
        $percent = (($selling - $cost) / $cost) * 100;
        return Numeral::number($percent)->format('0.0%');
    }

}

