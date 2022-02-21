<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\Register;
use Illuminate\Http\Request;


class StoreController extends Controller
{
   
    use Register;

    public function store(Request $request){
        $this->registerStep2($request);
    }


    public function update(Request $request) {
        $this->registerStep3($request);
    }


    public function getStoreProducts(){
        $products = Product::orderBy('id', 'desc')->paginate(50);
        return response()->json(['products' => $products]);
    }
}
