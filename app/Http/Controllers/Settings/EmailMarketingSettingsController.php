<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailMarketingSetting;

use Symfony\Component\HttpKernel\Exception\HttpException;



class EmailMarketingSettingsController extends Controller
{
    

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();

        try {
            $store = EmailMarketingSetting::updateOrCreate(
                ['store_id' => $user->store_id],
                [
                    'double_opt_in' => $request->double_opt_in,
                    'open_tracking' => $request->open_tracking,
                    'store_id' =>  $user->store_id,
                ]
            );
            \Log::info("Updated Email Marketing Settings".  collect($request->all()));
            return response()->json(['message' => "Settings saved successfully."], 200);
        } catch (\Throwable $th) {
            return response()->json(['message'=> "Failed to save settings"], 422);
            \Log::Error("Failed to save  settings  with" . collect($request->all())  ."  Error: " .$th->getMessage() );
        }
    } 
}
