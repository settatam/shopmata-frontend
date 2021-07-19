<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class OnlineStoreController extends Controller
{
    //
    public function index(){
        return Inertia::render('OnlineStore/Index');
    }
    public function blogPost(){
        return Inertia::render('OnlineStore/BlogPost');
    }
    public function createNewPage(){
        return Inertia::render('OnlineStore/CreateNewPage');
    }
    public function createBlogPost(){
        return Inertia::render('OnlineStore/CreateBlogPost');
    }
}

