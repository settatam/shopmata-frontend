<?php

namespace App\Http\Controllers;

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
use Illuminate\Support\Facades\Log;
use App\Models\TransactionNote;
use App\Traits\FileUploader;
use Illuminate\Support\Facades\Storage;







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
        $filter = [];
//        Transaction::search($filter);

        $transactions = Transaction::with('items','customer','images')
                                ->where('store_id',session('store_id'))
                                ->latest()
                                ->paginate(10);
        $transactions->load('customer.state');
        return Inertia::render('Transactions/Index',compact('transactions'));
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
        $transaction                 = Transaction::findorFail($id);
        $statuses                    = Status::all();
        $store_id                    = session('store_id');
        $transaction_item_categories = Category::where(['store_id' => $store_id, 'type' => 'transaction_item_category' ])->get();
        $transaction_categories      = Category::where(['store_id' => $store_id, 'type' => 'transaction_category' ])->get();
        $transactions                = Transaction::where(['customer_id' => optional($transaction->customer)->id, 'store_id' => $store_id ])->get();
        $top_tags                    = Tag::where(['store_id' => $store_id, 'group_id' => 1])->get();
        $bottom_tags                 = Tag::where(['store_id' => $store_id, 'group_id' => 2])->get();
        $transaction->load('customer','customer.state','items','items.images','histories','offers','public_note.images','notes','sms','images', 'activities','transaction_payment_address','transaction_payment_address.transaction_payment_type','tags','public_note','private_note');
        $timeline = $transaction->historyTimeline();
        return Inertia::render('Transactions/Show', compact('transaction','transaction_item_categories','transaction_categories','statuses','transactions','top_tags','bottom_tags', 'timeline'));
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
    public function addTag(Request $request)
    {
        try {
            $transaction = Transaction::findOrFail($request->transaction_id);
            //This will become a problem if we don't have a store ....
            $store_tag   =  StoreTag::where(
                                [
                                    'tagable_id' => $request->transaction_id,
                                    'tag_id'     => $request->tag_id
                                ]
                            )->first();
            if (null !== $store_tag){
                $store_tag->delete();
                Log::info("Tag(s) deleted!", );
                return response(null,200);
            } else {
                $tags  = new StoreTag(['tag_id' => $request->tag_id]);
                if ( $transaction->tags()->save($tags) ) {
                    Log::info("Tag(s) Added!", );
                    return response(null,200);
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
            \Log::Error("Failed to add or delete  tag  with" . collect($request->all())  ."  Error: " .$th->getMessage() );
        }


        return response(null,422);
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

            $image  = FileUploader::upload($request);
            if ( isset($image[0]['thumb']) ){
                $l_image = $image[0]['thumb'];
                $tn_image = $image[0]['large'];
                $imgs= new Image(['url' => $l_image, 'thumbnail' =>  $tn_image, 'rank' => 1]);
                $customer_note->images()->save($imgs);
            }

            return response()->json($customer_note->images,  200);
        } catch (\Throwable $th) {
            \Log::Error("Failed to Add image" . collect($request->all())  ."  Error: " .$th->getMessage() );
            return response($th->getMessage() ,422);
        }

        return response("Something went wongr" ,422);
    }


    public function addNote(Request $request)
    {
        try {
            $transaction = TransactionNote::updateOrCreate(
                ['customer_id' => $request->customer_id,'transaction_id' =>  $request->transaction_id, 'type' => $request->type],
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
            $image  = Image::findorFail($request->image_id);

            if ($image->url){
                Storage::disk('DO')->delete($image->url); 
            }

            if ($image->thumb){
                Storage::disk('DO')->delete($image->thumb); 
            }

            $image->delete();
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function extra(Request $request, $id, $action)
    {
        //
        $input = $request->input();

        //How do we perform validation here???

        switch ($action) {
            case 'images':
                $this->addImage();
                break;
            case 'sms':
                $this->sendSms($input);
                break;
            case 'status':
                $this->updateStatus($input);
                break;
//            case:

        }

        $transaction = Transaction::find($id);
        if($transaction->doUpdate($input)) {
            return response()->json($transaction);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
