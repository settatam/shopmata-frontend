<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Transaction;
use Illuminate\Support\Facades\Http;
use App\Models\Category;
use App\Models\Status;
use App\Models\Tag;
use App\Models\StoreTag;
use Illuminate\Support\Facades\Log;
use App\Models\TransactionNote;





class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        
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
        $transaction  = Transaction::find($id);
        $statuses     = Status::all();
        $store_id     = session('store_id');
        $categories   = Category::where('store_id',$store_id)->get();
        $transactions = Transaction::where(['user_id' => optional($transaction->customer)->id, 'store_id' => $store_id ])->get();
        $top_tags     = Tag::where(['store_id' => $store_id, 'group_id' => 1])->get();
        $bottom_tags  = Tag::where(['store_id' => $store_id, 'group_id' => 2])->get();
        $transaction->load('customer','customer.state','items','items.images','histories','offers','notes','sms','images', 'activities','items','transaction_payment_address','transaction_payment_address.transaction_payment_type','tags');
        return Inertia::render('Transactions/Show', compact('transaction','categories','statuses','transactions','top_tags','bottom_tags'));
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


    public function addNote(Request $request)
    {   
        try {
            
            $transaction = TransactionNote::updateOrCreate(
                ['user_id' => $request->customer_id,'transaction_id' =>  $request->transaction_id, 'type' => $request->type],
                ['notes' => $request->message, 'user_id' => $request->customer_id, 'type' => $request->type, 'transaction_id' =>  $request->transaction_id]
            );
            
            if ( $transaction ) {
                Log::info("Note(s) Updated!", );
                return response(null,200);
            }
            
        } catch (\Throwable $th) {
            \Log::Error("Failed to Update  Note" . collect($request->all())  ."  Error: " .$th->getMessage() );
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
