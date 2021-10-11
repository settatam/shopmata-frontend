<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StoreLocation;
use Auth;
use Illuminate\Support\Facades\Log;

class StoreLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $locations = StoreLocation::orderBy('created_at')->paginate();
        return response()->json($locations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

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
        if(Auth::user()->canDo('add-store-location')){
            $data = $request->input();
            
            $request->validate([
                'address'=>['required']
            ]);

            $data['store_id'] = $request->session()->get('store_id');
            
            if($create = StoreLocation::create($data)) {
                Log::info('User ' . Auth::id() . ' created a store location ', $data);
                return response()->json(['success'=>true]);
            }else{
                Log::error('User ' . Auth::id() . ' could not create a store location ', $data);
                return response()->json(['success'=>false], 422);
            }
        }else{
            return response()->json(['success'=>false, 'message'=>'You do not have permissions to add a new store'], 422);
        }
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
        if(Auth::user()->canDo('view-store-location')){
            $location = StoreLocation::find($id);
            if(null !== $location) {
                return response()->json($location);
            }else{
                return response()->json(['success'=>false, 'message'=>'This store does not exist'], 422);
            }
        }

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
        if(Auth::user()->canDo('delete-store-location')){
            $location = StoreLocation::find($id);
            if(null !== $location) {
                if($location->delete()) {
                    Log::info('User ' . Auth::id() . ' deleted a store location ' . $id);
                    return \Redirect::route('settings.shipping');
                    // return response()->json(['success'=>true]);

                }else{
                    Log::error('User ' . Auth::id() . ' could not delete a store location ' . $id);
                    return \Redirect::route('settings.shipping');
                    // return response()->json(['success'=>false], 422);
                }
            }else{
                //
                return \Redirect::route('settings.shipping');
                // return response()->json(['success'=>false, 'message'=>'You do not have permissions to delete a store'], 422);
            }
        }
    }
}
