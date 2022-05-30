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
    public function addImage(Store $store, $images, $id = null, $rank = 1)
    {
        $transaction = Transaction::find($id);
        $note = $transaction->getPublicNote();
        if ($data = $this->uploadImageToCloud($store, $images)) {
            $image = $note->images()->create([
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

            return $image;
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
