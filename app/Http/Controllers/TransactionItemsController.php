<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionItem;


class TransactionItemsController extends Controller
{


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $item = TransactionItem::find($request->item_id);
            $transaction = Transaction::find($item->transaction_id);
            TransactionItem::createUpdateItem($request, $item);
            $transaction->load('items','items.images');
            return response()->json($transaction,  200);
        } catch (\Throwable $th) {
            \Log::Error("Failed to update item" . collect($request->all())  ."  Error: " .$th->getMessage() );
            return response("Something went wrong", 422);
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
        try {
            $item = TransactionItem::find($id);
            $transaction = Transaction::find($item->transaction_id);
            $item->delete();
            $transaction->load('items','items.images');
            return response()->json($transaction,  200);
        } catch (\Throwable $th) {
            \Log::Error("Failed to delete item"  ."  Error: " .$th->getMessage() );
            return response("Something went wrong", 422);
        }
    }
}
