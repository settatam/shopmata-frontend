<?php

namespace App\Http\Controllers;

use App\Helpers\Filter;
use App\Models\Activity;
use App\Models\EventCondition;
use App\Services\EventNotification;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Transaction;
use Illuminate\Support\Facades\Http;
use App\Models\Category;
use App\Models\Image;
use App\Models\Status;
use App\Models\Tag;
use App\Models\StoreTag;
use App\Models\TransactionItem;
use App\Models\StoreNotification;
use Illuminate\Support\Facades\Log;
use App\Models\TransactionNote;
use App\Traits\FileUploader;
use Illuminate\Support\Facades\Storage;
use App\Models\MetalPrice;
use App\Services\Barcode;
use function Aws\map;
use Numeral\Numeral;

class TransactionsController extends Controller
{

    use FileUploader;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = $request->input();
        $filters['page'] = Filter::page($filters);
        $filters['type'] = 'TransactionsTable';
        $filters['term'] = '';
        $filters['refresh_token'] = '';
        $perPage = Filter::perPage($filters);
        return Inertia::render('Transactions/Index',compact('filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storag:wq
     * e.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $filter = [];
        $transaction = Transaction::search([])
            ->withEstValue()
            ->withFinalOffer()
            ->withTotalDwt()
            ->withLabelsFrom()
            ->withLabelsTo()
            ->withReturnLabel()
            ->withPrivateNote()
            ->withPublicNote()
            ->withPaymentType()
            ->withPaymentDateTime()
            ->withOfferGivenDateTime()
            ->withOfferAcceptedDateTime()
            ->withKitSentDateTime()
            ->withStatusDateTime()
            ->withReceivedDateTime()
            ->with('customer','customer.address','customer.lead','customer.state','items','items.category','items.images','histories','offers','sms','images', 'activities','customer.payment_address','customer.payment_address.payment_type','tags')
            ->find($id);

        $note = $transaction->getPublicNote();
        $transaction->load('publicnote.images');

        $transaction->profit_percent = $transaction->getProfitPercent($transaction->offer, $transaction->est_value);
        $statuses                    = Status::orderBy('sort_order')->get();
        $store_id                    = session('store_id');
        $transaction_item_categories = Category::where(['store_id' => $store_id, 'type' => 'transaction_item_category' ])->get();
        $transaction_categories      = Category::where(['store_id' => $store_id, 'type' => 'transaction_category' ])->get();
        $top_tags                    = Tag::where(['store_id' => $store_id, 'group_id' => 1])->get();
        $bottom_tags                 = Tag::where(['store_id' => $store_id, 'group_id' => 2])->get();
        $timeline = $transaction->historyTimeline();
        return Inertia::render('Transactions/Show', compact('transaction','transaction_item_categories','transaction_categories','statuses','top_tags','bottom_tags','timeline'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addTag(Request $request, $id)
    {
        try {
            Transaction::addTag($request->tag_id, $id);
            return response(null, 200);
        } catch (\Throwable $th) {
            //throw $th;
            \Log::Error("Failed to add or delete  tag  with" . collect($request->all())  ."  Error: " .$th->getMessage() );
            return response(null, 422);
        }
        return response(null,422);
    }

    public function addItem(Request $request)
    {
        try {
            TransactionItem::addItem($request);
        } catch (\Throwable $th) {
            \Log::Error("Failed to Add image" . collect($request->all())  ."  Error: " .$th->getMessage() );
            return response($th->getMessage() ,422);
        }

        return response("Something went wrong" ,422);
    }


    public function addImage(Request $request)
    {
        try {
            $transaction = Transaction::find($request->transaction_id);
            $customer_note = TransactionNote::firstOrNew(
                ['id' => optional($transaction->public_note)->id]
            );
            $customer_note->transaction_id = $request->transaction_id;
            $customer_note->customer_id    = $request->customer_id;
            $customer_note->type           = 'public';
            $customer_note->save();
            //return response()->json($customer_note->images,  200);
        } catch (\Throwable $th) {
            \Log::Error("Failed to Add image" . collect($request->all())  ."  Error: " .$th->getMessage() );
            return response($th->getMessage() ,422);
        }

        return response("Something went wrong" ,422);
    }


    public function addNote(Request $request)
    {

        try {
            $transaction = TransactionNote::updateOrCreate(
                ['transaction_id' =>  $request->transaction_id, 'type' => $request->type],
                ['notes' => $request->message, 'customer_id' => $request->customer_id, 'type' => $request->type, 'transaction_id' =>  $request->transaction_id]
            );

            if ( $transaction ) {
                $transaction  = Transaction::findorFail($request->transaction_id);
                Log::info("Note(s) Updated!");
                return response($transaction->load('publicNote','privateNote'),200);
            }

        } catch (\Throwable $th) {
            \Log::Error("Failed to Update  Note" . collect($request->all())  ."  Error: " .$th->getMessage() );
        }


        return response(null,422);
    }


    public function deleteTransactionNoteImage(Request $request)
    {
        try {
            Image::deleteImage($request);
            Log::info("Image(s) Delete!");
            return response("Image deleted ",200);
        } catch (\Throwable $th) {
            \Log::Error("Failed to delete  image" . collect($request->all())  ."  Error: " .$th->getMessage() );
        }
        return response(null,422);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $input = $request->input();
        //How do we perform validation here???
        $transaction = Transaction::find($id);
        if($transaction->doUpdate($input)) {
            return response()->json($transaction);
        }
    }


    public function messages(Request $request) {
        $user = $request->user();
        $messages = StoreNotification::all();
        //dd();
        $store_notifiction_id = null;
        return Inertia::render('Messages/Create', compact('messages','store_notifiction_id'));
    }

    public function sendMessages(Request $request) {

        $user = $request->user();
        try {
            StoreNotificationMessage::addNotification($request, $user);
            $transactions = Transaction::whereIn('id', $request->transaction_id)->get();
            $store_notification = StoreNotification::find($request->store_notification_id);

            $name = $request->title ?? $store_notification->name;

            foreach ($request->transactions as  $transaction_id) {
                //send message
                $transaction = Transaction::find($transaction_id);

                (new EventNotification($name, [
                    'customer' => $transaction->customer,
                    'transaction' => $transaction
                    //'store' => $store
                ]));
            }
            \Log::info("Updated store  notifications with".  collect($request->all()));
            return response()->json(['message' => "Notification saved successfully."], 200);
        } catch (\Throwable $th) {
            \Log::error("Failed to Update store actual notifications with" . collect($request->all())  ."Error: " .$th->getMessage() );
            return response()->json(['message'=>$th->getMessage()], 422);
        }

    }

    public function bulkPrintAction(Request $request) {
        $transactions = json_decode($request->input()['transactions'], true);
        $printables = [];

        switch ($request->action) {
            case 'barcode':
                foreach($transactions as $transaction) {
                    $transactionObj = Transaction::find($transaction['id']);
                    $printables[] = [
                        'barcode' => Barcode::generate($transactionObj),
                        'qty' => $transaction['qty']
                    ];

                    $transactionObj->addActivity($transactionObj, [], Activity::TRANSACTION_CREATE_BARCODE);
                }
                return view('pages.barcode', compact('printables'));
                break;
            case 'label':
                 foreach($transactions as $transaction) {
                    $tr = Transaction::find($transaction['id']);
                    //We must ensure the user has a full address
                    if($shippingLabel = $tr->getShippingLabel($transaction['direction'], true)) {
                        //Update the status to Kit Sent
                        $tr->doUpdate(['status_id' => 1]);
                        $printables[] = [
                            'label' => $shippingLabel,
                            'qty' => $transaction['qty']
                        ];
                    }else{

                    }
                 }

                 return view('pages.label', compact('printables'));
                 break;
            default:
                dd($request->action);

        }



    }

    public function bulkAction(Request $request, $action) {

//        if($printable !== 'barcode' && $printable !== 'label') {
//            abort(404);
//        }

        $input = $request->input();
        $queryObj = Transaction::whereIn('id', $input['transactions']);
        $transactionObj = $queryObj->get();

        if($input['action'] == 'Create Barcodes') {
            $transactionObj->map(function(Transaction $transaction){
                    $transaction->qty = 5;
            });
            return Inertia::render('Transactions/BulkPrintBarcode', [
                'transactions' => $transactionObj
            ]);
        }else if($input['action'] == 'Create Shipping Label' ) {
            $direction = str_replace('label', '', $input['action']);
            $to = $transactionObj->map(function(Transaction $transaction) {
                return [
                    'id' => $transaction->id,
                    'qty' => 1,
                    'direction' => 'to'
                ];
            });

            $from = $transactionObj->map(function(Transaction $transaction) {
                return [
                    'id' => $transaction->id,
                    'qty' => 1,
                    'direction' => 'from'
                ];
            });

            $merged = $to->merge($from)->sortBy('id');
            $transactions = $merged->values()->all();

            return Inertia::render('Transactions/BulkPrintLabel', compact('transactions'));
        }else if(is_numeric($input['action'])) {
            foreach($transactionObj as $transaction) {
                $transaction->doUpdate(['status_id' => $input['action']]);
            }

            unset($input['transactions']);
            unset($input['action']);
            unset($input['page']);
            unset($input['type']);

            return redirect()->route('transactions.index', $input);
        }else if($input['action'] == 'Bin Location') {
            foreach($transactionObj as $transaction) {
                $req = ['bin_location' => $request->bin_location];
                $transaction->doUpdate($req);
            }
            //return redirect()->route('transactions.index', $input);
            return response()->json('done');
        }else if($input['action'] == 'Delete') {
            $queryObj->delete();
            return response()->json('done');
            //return redirect()->route('transactions.index', $input);
        }
    }

    public function printable(Request $request, $id, $printable) {

        if($printable !== 'barcode' && $printable !== 'label') {
            abort(404);
        }

        $transaction = Transaction::find($id);
       switch($printable) {
           case 'barcode':
               $printables = [
                   [
                       'barcode' => Barcode::generate($transaction),
                       'qty' => 5
                   ]
               ];
               $transaction->addActivity($transaction, [], Activity::TRANSACTION_CREATE_BARCODE);
               return view('pages.barcode', compact('printables'));
               break;
           case 'label':
               $shippingLabel = $transaction->getShippingLabel($request->direction, $request->is_return);
               $printables[] = [
                   'label' => $shippingLabel,
                   'qty' => 1
               ];
//               $transaction->addActivity($transaction, [], Activity::TRANSACTION_CREATE_BARCODE);
               return view('pages.label', compact('printables'));
               break;
           default:
               echo 'no';
       }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function extras(Request $request, $id, $action)
    {
        //
        $input = $request->input();
        $transaction = Transaction::find($id);

        //How do we perform validation here???

        switch ($action) {
            case 'images':

                try {
                    $customer_note = TransactionNote::firstOrNew(
                        ['id' => optional($transaction->publicNote)->id]
                    );
                    $image  = FileUploader::upload($request);
                    if ( isset($image[0]['thumb']) ){
                        $l_image = $image[0]['large'];
                        $tn_image = $image[0]['thumb'];
                        $imgs= new Image(['url' => $l_image, 'thumbnail' =>  $tn_image, 'rank' => 1]);
                        $customer_note->images()->save($imgs);
                        $note = sprintf('%s added a new image', Auth::user()->full_name);
                        return $note;
                       // $transaction->addActivity($transaction, [], $note);
                    }

                } catch (\Throwable $th) {
                    \Log::Error("Failed to Add image" . collect($request->all())  ."  Error: " .$th->getMessage() );
                    return response($th->getMessage() ,422);
                }

                return response("Something went wrong" ,422);
                break;
            case 'items':
                try {
                    $transaction = Transaction::find($request->transaction_id);
                    $item = new TransactionItem;
                    TransactionItem::createUpdateItem($request, $item);
                } catch (\Throwable $th) {
                    \Log::Error("Failed to Add item" . collect($request->all())  ."  Error: " .$th->getMessage() );
                    return response($th->getMessage() ,422);
                }
                break;
            case 'dwt':
                    try {
                        $metal = Category::find($request->category_id);
                        $price =  MetalPrice::calcSpotPrice($metal->name, $request->dwt);
                        $price = ['price' => $price];
                        return response()->json($price,  200);
                    } catch (\Throwable $th) {
                        \Log::Error("Failed to create price " . collect($request->all())  ."  Error: " .$th->getMessage() );
                        return response($th->getMessage() ,422);
                    }
                    break;
            case 'sms':
                $transaction->sendSms($input['message'], $request->images);
                break;
            case 'offer':
                $transaction->addOffer($input['offer']);
                break;
            case 'create-new-kit':
                $newKit = $transaction->createNewFromTransaction();
                return response()->json($newKit);
            case 'tags':
                $this->addTag($request, $id);
                break;

            case 'messages':
                $transaction->createNote($input['type'], $input['message']);
            case 'status':
                $transaction->doUpdate($input);
                break;
//            case:
        }

        $transaction = Transaction::search([])
            ->withEstValue()
            ->withFinalOffer()
            ->withTotalDwt()
            ->withLabelsFrom()
            ->withLabelsTo()
            ->withPrivateNote()
            ->withPublicNote()
            ->withPaymentType()
            ->withStatusDateTime()
            ->withReceivedDateTime()
            ->withPaymentDateTime()
            ->withPaymentDateTime()
            ->with('customer','customer.state','items','items.category','items.images','histories','offers','sms','images', 'activities','customer.payment_address','customer.payment_address.payment_type','tags')
            ->find($id);


        return response()->json($transaction);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        foreach ( $request->transaction_ids as $transaction_id ){
            $transaction = Transaction::find($transaction_id);
            $transaction->delete();
        }

        return redirect('transactions.index');
    }
}


