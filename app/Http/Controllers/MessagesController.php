<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sms;
use Inertia\Inertia;


class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $store_id     = session('store_id');
        $messages = Sms::where('store_id', $store_id)->latest()->paginate(25);
        $messages->load('transaction','images');
        return Inertia::render('Messages/Index',  compact('messages'));
    }

    
}
