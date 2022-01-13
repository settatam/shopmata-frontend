<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PayoutSetting;
use Inertia\Inertia;


use Symfony\Component\HttpKernel\Exception\HttpException;



class PayoutSettingsController extends Controller
{
    
    public function index(){

        $user = request()->user();
        $remittance =PayoutSetting::where('store_id',$user->store_id)->first(); 
        return Inertia::render('Settings/Remittance/Index',compact('remittance'));
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $request->validate([
            'account_name'=>['required'],
            'payout_schedule'=>['required'],
            'account_number'=>['required']
        ]);

        $user = request()->user();

        
        $request->validate([
            'account_name'=>['required'],
            'payout_schedule'=>['required'],
            'account_number'=>['required']
        ]);


        try {
            $payout_setting = new PayoutSetting;
            $this->updateOrCreate($payout_setting, $request);
            \Log::info("Created Payout Settings".  collect($request->all()));
            return response()->json(['message' => "Settings saved successfully."], 200);
        } catch (\Throwable $th) {
            return response()->json(['message'=> "Failed to save payout settings" .$th->getMessage() ], 422);
            \Log::Error("Failed to save  settings  with" . collect($request->all())  ."  Error: " .$th->getMessage() );
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
        $remittance =PayoutSetting::find($id); 
        return Inertia::render('Settings/Remittance/Edit',compact('remittance'));
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
        $request->validate([
            'account_name'=>['required'],
            'payout_schedule'=>['required'],
            'account_number'=>['required']
        ]);

        $user = request()->user();

        try {
            $payout_setting = PayoutSetting::find($id);
            $this->updateOrCreate($payout_setting, $request);
            \Log::info("Updated Payout Settings".  collect($request->all()));
            return response()->json(['message' => "Settings saved successfully."], 200);
        } catch (\Throwable $th) {
            return response()->json(['message'=> "Failed to save payout settings" .$th->getMessage() ], 422);
            \Log::Error("Failed to save  settings  with" . collect($request->all())  ."  Error: " .$th->getMessage() );
        }
    
    }


    public function updateOrCreate($payout_setting, $request){
        $user = request()->user();
        $payout_setting->store_id        = $user->store_id;
        $payout_setting->account_number  = $request->account_number;
        $payout_setting->routing_number  = $request->routing_number;
        $payout_setting->account_name    = $request->account_name;
        $payout_setting->bank_name       = $request->bank_name;
        $payout_setting->payout_schedule = $request->payout_schedule;
        $payout_setting->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = request()->user();
            $payout_setting = PayoutSetting::find($id);
            $payout_setting->delete();
            \Log::info("Deleted Payout Settings");
            return response()->json(['message' => "Payout Settings deleted successfully."], 200);
        } catch (\Throwable $th) {
            return response()->json(['message'=> "Failed to delete payout settings"], 422);
            \Log::Error("Failed to save  settings  with" . collect($request->all())  ."  Error: " .$th->getMessage() );
        }
    }

}
