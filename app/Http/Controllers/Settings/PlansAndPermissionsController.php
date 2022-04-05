<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StoreUser;
use Illuminate\Support\Facades\Log;
use Auth;
use Inertia\Inertia;

class PlansAndPermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if(Auth::user()->canDo('edit-store-user')){
            $user = StoreUser::with('group')->find($id);
            if($user !== null) {
                return response()->json($user);
            }else{
                return response()->json('Could not find a user', 422);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function response(Request $request)
    {
        //
        $data = $request->all();
        $store = Store::find(session('store_id'));
        StoreUser::respondToUserRequest($data, $store);
        Inertia::render('Dashboard');
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
        if(Auth::user()->canDo('delete-store-user')){
            $user = StoreUser::find($id);
            if(null !== $user) {
                if($user->delete()) {
                    Log::info('User ' . Auth::id() . ' deleted a store user ' . $id);
                    return redirect()->route('settings.permissions');
                }else{
                    Log::error('User ' . Auth::id() . ' could not delete store user ' . $id);
                    return redirect()->route('settings.permissions');
                }
            }else{
                //
                return redirect()->route('settings.permissions');
            }
        }
    }
}
