<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreEngagementPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_engagement_id',
        'page_url',
        'query_params'
    ];

   public static function createOrUpdate($data) {
    return   self::updateOrCreate(
         ['store_engagement_id' => $data['store_engagement_id']],
         $data
     );
    }
}
