<?php

namespace App\Traits;

use View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use Twig;
use Illuminate\Filesystem\Filesystem;
use App\Models\Store;

trait FileUploader {

	public function uploadImage() {

	}

	//This is for themefiles
	public function uploadAsset() {
		
		$needs_interpretation = false;
		
		if(strpos($this->title, 'js.twig') !== false) {
			//File is a js.twig
		}else if(strpos($this->title, 'css.twig') !== false) {
			//File is a css.twig
		}else if(strpos($this->title, 'css') !== false) {
			//plain css file
		}else if(strpos($this->title, 'js') !== false) {
			//plain js file
		}else{
			return false;
		}

		$file_name = str_replace('.twig', '', $this->title);
		$store = Store::find(session()->get('store_id'));

		$slug = $store->slug;
		$content = $this->content;

		Storage::disk('DO')->put($slug.'/'.$file_name, View::make('theme_files.index', compact('content')), 'public');

	}
}