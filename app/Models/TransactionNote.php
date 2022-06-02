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
        $transaction   = Transaction::find($request->transaction_id);
        if ($data = $this->uploadImageToCloud($store, $images)) {
            $note = $this->getPublicNoteForTransaction($transaction);
            $note->images()->create([
                'url' => $data['url'],
                'thumbnail' => $data['thumb'],
                'rank' => $rank,
            ]);

            $note = sprintf(
                '%s added a new image: %s',
                Auth::user()->full_name,
                $data['url']
            );

            $transaction->addActivity($transaction, [], $note);
            return $transaction->publicnote->images;
        }

    }

    public function getPublicNoteForTransaction($transaction) {
        $note = $transaction->publicnote;

        if(null !== $note) {
            return $note;
        }
        return  $transaction->publicnote()->create([
            'type' => 'public',
            'notes' => '',
        ]);
    }

    public function transaction() {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'id');
    }

}
