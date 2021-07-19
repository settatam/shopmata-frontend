<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\StoreDomain;
use Illuminate\Support\Facades\Log;
use App\Models\Whois;
use Auth;

class StoreDomainsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $shopmata_domain = StoreDomain::where('is_shopmata', 1)->get();
        $custom_domains = StoreDomain::where('is_shopmata','<>', 1)->orderBy('created_at')->get();
        return Inertia::render('StoreDomains/Index', compact('shopmata_domain', 'custom_domains'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return Inertia::render('StoreDomains/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->has('name') && $request->name) {
            $whois = new Whois($request->name);
            $request->name = $whois->getDomainName();
        }
        
        $validatedData = $request->validate([
            'name' => 'required|unique:store_domains|max:150',
        ]);

        // if($domain->createNewRecord($request->name)) {
        //     //Log
        //     return 
        // }

        $whois = new Whois($request->name);

        $data['name'] = $request->name;
        $data['region'] = 'none';
        $data['languages'] = 'en';
        $data['is_active'] = 0;
        $data['domain_registrar'] = 'none'; #couln't detect it
        $data['store_id'] = $request->session()->get('store_id');

        if($whois->getDomainStatus()) {
            $data['domain_registrar'] = $whois->getRegistrar();
        }

        ##can we format the date / timezone for the user 

        if($domain = StoreDomain::create($data)) {
            Log::info(Auth::id() . 'created a new domain record', $data);
            return response()->json($domain);
        }else{
            Log::error(Auth::id() . 'could not create a new domain record', $data);
            return response()->json($domain);
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
