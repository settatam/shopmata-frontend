<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorePage extends Model
{
    //Every page should have a template.
    //The template should contain a section for page variable for the page content to fill
    //

    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'theme_file_id',
        'store_id',
        'store_id',
        'footer_content',
        'title',
        'seo_content'
    ];

    public function theme() {
        return $this->belongsTo(ThemeFile::class, 'theme_id', 'id');
    }

    public function template() {
        return $this->belongsTo(ThemeFile::class, 'template_id', 'id');
    }

    public function store() {
        return $this->belongsTo(Theme::class, 'template_id', 'id');
    }

    static function nameFromPath($path='') {
        if(!$path || $path == '/') return 'home';
        $hasSlash = strpos($path, '/');
        if($hasSlash === false) {
            return strtolower($path);
        }
        $paths = explode('/', $path);
        $numberOfPaths = count($paths);
//        $updatedPath = str_replace('/', '.');
        if($numberOfPaths === 2) {
           if(preg_match('/(\w+)\/(\d+)$/', $path)) {
               return strtolower($paths[0].'.detail');
           }else if(preg_match('/(\w+)\/(\w+)$/', $path)) {
               return strtolower(implode('.', $paths));
           }
        }else if($numberOfPaths === 3) {
            if(preg_match('/(\w+)\/(\d+)\/(\w+)$/', $path)) {
                return $paths[0].'.detail.'.$paths[2];
            }else if(preg_match('/(\w+)\/(\w+)\/(\d+)$/', $path)) {
                return strtolower($paths[0].'.'.$paths[1].'.detail');
            }
        }

        return '';
    }
}
