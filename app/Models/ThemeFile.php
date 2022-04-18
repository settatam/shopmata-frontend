<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\StoreScope;
use View;
use Illuminate\Filesystem\Filesystem;
use App\Traits\FileUploader;
use Auth;


class ThemeFile extends Model
{
    const DEFAULT_THEME_ID = 1;
    use HasFactory;
    use FileUploader;

    protected $fillable = [
    	'theme_id', 'title', 'content', 'asset_url', 'user_id', 'type', 'store_id', 'type_id'
    ];

    protected static function booted()
    {
//        static::addGlobalScope(new StoreScope);
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

    public static function getForStore(){
        $files = self::distinct('title')->get(['title', 'type_id', 'type', 'content', 'id']);

        $theme_files = [];

        $layout_files = [];
        $template_files = [];
        $asset_files = [];
        $layout = '';

        foreach ($files as $file) {
            $theme_files[$file->type_id][] =
                ['title' => $file['title'],
                 'content' => $file['content'],
                 'type' => $file['type'],
                 'id' => $file->id
             ];
        }

        count($theme_files) === 0 ? $theme_files = (object)[] : "";

        return $theme_files;

    }

    public static function getTemplateFor(Store $store, $page) {
        $page .= '.twig';
        $themeId = $store->theme_id ?? self::DEFAULT_THEME_ID;
        return self::where('store_id', $store->id)
            ->where('title', $page)
            ->where('theme_id', $themeId)
            ->first();
    }

    static function generateParsedContent($content, $data) {
        $message = \Twig::createTemplate($content);
        return \Twig::render($message, $data);
    }

}
