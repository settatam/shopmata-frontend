<?php

namespace App\Http\Controllers\OnlineStore;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Navigation;
use App\Models\NavigationList;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
use Auth;


class NavigationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $menu = Navigation::orderBy('created_at', 'asc')->get();
        return Inertia::render('OnlineStore/Navigation/Index', compact('menu'));
        // return 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return Inertia::render('OnlineStore/Navigation/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|max:255',
            'handle' => 'required',
        ]);

        $data = [
            'name'=>$request->name,
            'handle'=>$request->handle,
            'store_id'=>$request->session()->get('store_id')
        ];

        if(Navigation::create($data)) {
            Log::info(Auth::id() . ' created a new menu item ', $data);
        }else{
            Log::error(Auth::id() . ' could not create a new menu item ', $data);
        }

        return \Redirect::route('navigation.list');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeList($id,Request $request)
    {
        //
        $request->validate([
            'name' => 'required|max:255',
            'handle' => 'required',
        ]);

        $data = [
            'name'=>$request->name,
            'link'=>$request->link,
            'navigation_id'=>$id
        ];

        $nav = NavigationList::where('name', $request->name)->first();
        if(null !== $nav) {
            return \Redirect::route('navigation.show', ['id' => $id]);
        }

        if(NavigationList::create($data)) {
            Log::info(Auth::id() . ' created a new menu list item ', $data);
        }else{
            Log::error(Auth::id() . ' could not create a new menu list item ', $data);
        }

        return \Redirect::route('navigation.show', ['id' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $menu = Navigation::with('list')->find($id);
        return Inertia::render('OnlineStore/Navigation/Show', compact('menu')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
