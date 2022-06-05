<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\StoreScope;

class OpenEditorPage extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::addGlobalScope(new StoreScope);
    }

    protected $fillable = [
    	'store_id', 'user_id', 'theme_file_id', 'is_open'
    ];

    public function theme_file() {
    	return $this->belongsTo(ThemeFile::class, 'theme_file_id', 'id');
    }

    static function forStore(Store $store) {
        $files = self::with('theme_file')
            ->where('store_id', $store->id)
            ->orderBy('id', 'asc')
            ->get();

        return $files->map(function(OpenEditorPage $page){
            return [
                'title' => $page->theme_file->title,
                'content' => $page->theme_file->content,
                'id' => $page->id,
                'edited_content' => $page->theme_file->content
            ];
        });
    }
}
