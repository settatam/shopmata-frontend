<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sms;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Sms::lastest()->pagination(50);
        return Inertia::render('Messages/Index',  compact('messages'));
    }

    
}
