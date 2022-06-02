<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\FileUploader;
use Auth;

class TransactionNote extends Model
{
    use HasFactory, FileUploader;

    const PUBLIC_TYPE = 'public';
    const PRIVATE_TYPE = 'private';


    public $fillable = [
        'id',
        'notes',
        'type',
        'transaction_id',
        'customer_id'
    ];


    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
	}

    //Pass the transaction id for transaction notes
    public function addImage(Store $store, $request, $rank =1)
    {
        $images =  $request->file('files');
        $note   = TransactionNote::find($request->model_id);
        if ($data = $this->uploadImageToCloud($store, $images)) {
            if (null == $note) {
                $note = TransactionNote::create([
                    'type' => 'public',
                    'notes' => '',
                    'transaction_id' => $request->transaction_id
                ]);
            }


           // return $note;

            $note->images()->create([
                'url' => $data['url'],
                'thumbnail' => $data['thumb'],
                'rank' => $rank,
            ]);

            $note = sprintf(
                '%s added a new image: %s',
                Auth::user()->full_name,
                $image->url
            );

            $transaction->addActivity($transaction, [], $note);
            $transaction->load('publicnote.images');

            return $transaction->publicnote->images;
        }

    }

    public function getPublicNoteForTransaction() {
        $note = $this->transaction()->where('type', 'public')->latest()->first();

        if(null !== $note) {
            return $note;
        }
        return $this->transaction()->create([
            'type' => 'public',
            'notes' => '',
        ]);
    }

    public function transaction() {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'id');
    }

}
