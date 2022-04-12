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
        $messages = Sms::latest()->paginate(50);
        return Inertia::render('Messages/Index',  compact('messages'));
    }

    
}
