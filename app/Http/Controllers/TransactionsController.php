<?php

namespace App\Http\Controllers;

use App\Helpers\Filter;
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
        $perPage = Filter::perPage($filters);
        $transactions = Transaction::search($filters)
                        ->with('items','customer','images', 'customer.state')
                        ->paginate($perPage);
        return Inertia::render('Transactions/Index',compact('transactions', 'filters'));
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
            ->withPrivateNote()
            ->withPublicNote()
            ->withPaymentType()
            ->withStatusDateTime()
            ->withReceivedDateTime()
            ->withPaymentDateTime()

            ->withPaymentDateTime()
            ->with('customer.state','items','items.category','items.images','histories','offers','sms','images', 'activities','payment_address','tags')
            ->find($id);

        $transaction->profit_percent = $transaction->getProfitPercent($transaction->offer, $transaction->est_value);


//        $transaction                 = Transaction::with('shippingLabels')->findorFail($id);
        $statuses                    = Status::all();
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
                ['id' => optional($transaction->public_note)->id],
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
                Log::info("Note(s) Updated!", );
                return response($transaction->load('public_note','private_note'),200);
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
            Log::info("Image(s) Delete!", );
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

    public function bulkPrintAction(Request $request) {
        $transactions = json_decode($request->input()['transactions'], true);
        $printables = [];

        switch ($request->action) {
            case 'barcode':
                foreach($transactions as $transaction) {
                    $tr = Transaction::find($transaction['id']);
                    $printables[] = [
                        'barcode' => Barcode::generate($tr),
                        'qty' => $transaction['qty']
                    ];
                }
                return view('pages.barcode', compact('printables'));
                break;
            case 'label':
                 foreach($transactions as $transaction) {
                    $tr = Transaction::find($transaction['id']);

                    if($shippingLabel = $tr->getShippingLabel($transaction['direction'], true)) {
                        $printables[] = [
                            'label' => $shippingLabel,
                            'qty' => $transaction['qty']
                        ];
                    }
                 }

                 return view('pages.label', compact('printables'));
                 break;
            default:
                dd($request->action);

        }



    }

    public function bulkPrint(Request $request, $printable) {

//        if($printable !== 'barcode' && $printable !== 'label') {
//            abort(404);
//        }

        $input = $request->input();
        $transactions = Transaction::whereIn('id', $input['transactions'])->get();

        if($input['action'] == 'Create Barcodes') {
            $transactions->map(function(Transaction $transaction){
                return $transaction->qty = 5;
            });
            return Inertia::render('Transactions/BulkPrintBarcode', compact('transactions'));
        }else if($input['action'] == 'Create Shipping Label' || $input['action'] == 'label_from' ) {
            $direction = str_replace('label', '', $input['action']);
            $transactions->map(function(Transaction $transaction) use ($direction) {
                return [$transaction->qty = 1, $transaction->direction = $direction];
            });
            return Inertia::render('Transactions/BulkPrintLabel', compact('transactions'));
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
                   'barcode' => Barcode::generate($transaction),
                   'qty' => 5
               ];
               return view('pages.barcode', compact('printables'));
               break;
           case 'label':
//               $transaction->getShippingLabel();
               $printables = $transaction->shippingLabels;
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
                        ['id' => optional($transaction->public_note)->id],
                    );

                    $image  = FileUploader::upload($request);

                    if ( isset($image[0]['thumb']) ){
                        $l_image = $image[0]['large'];
                        $tn_image = $image[0]['thumb'];
                        $imgs= new Image(['url' => $l_image, 'thumbnail' =>  $tn_image, 'rank' => 1]);
                        $customer_note->images()->save($imgs);
                    }

                    return response()->json($customer_note->images,  200);
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
                    $transaction->load('items','items.images','items.category');
                    return response()->json($transaction,  200);

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
                $transaction->sendSms($input['message']);
                break;
            case 'offer':
                $transaction->addOffer($input['offer']);
                break;
            case 'tags':
                $this->addTag($request, $id);
                break;
            case 'status':
                $transaction->doUpdate($input);
                break;
//            case:

        }

        $transaction = Transaction::find($id);
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


