<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\StoreScope;
use View;
use Illuminate\Filesystem\Filesystem;
use App\Traits\FileUploader;


class ThemeFile extends Model
{
    use HasFactory;
    use FileUploader;

    protected $fillable = [
    	'theme_id', 'title', 'content', 'asset_url', 'user_id', 'type', 'store_id', 'type_id'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new StoreScope);
    }

    public function theme() {
    	return $this->belongsTo(Theme::class, 'theme_id', 'id');
    }
    
    public function uploadToCloud() {
    	//We are only going to be doing this for css and js files
    	
    	$fs = new Filesystem();
        $data = array();
        $fs->put(public_path()."/exercise.html", View::make('home.index', compact('layout','content')));
        dd('yes');
    }

}
