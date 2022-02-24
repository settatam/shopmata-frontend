<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\Register;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterStep2Request;



class StoreController extends Controller
{
   
    use Register;

    public function __construct() {
        $this->middleware('auth');
    }

    public function store(RegisterStep2Request $request)
    {
       return  $this->registerStep2($request);
    }

    public function update(Request $request) 
    {
       return $this->registerStep3($request);
    }


    public function getStoreProducts(){
        $products = Product::orderBy('id', 'desc')->paginate(50);
        return response()->json(['products' => $products]);
    }
}
