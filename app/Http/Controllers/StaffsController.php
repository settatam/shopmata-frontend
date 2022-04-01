<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Staff;
use App\Models\Store;
use App\Models\Invite;
use App\Mail\InviteUser;
use App\Models\StoreUser;
use App\Mail\NewStoreUser;
use App\Models\StoreGroup;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class StaffsController extends Controller
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
        $roles = StoreGroup::where('name', "!=", 'Owner')->get();
        return Inertia::render('Settings/InviteStaff', compact('roles'));
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
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        //
    }

    public function inviteStaff(Request $request)
    {
            $data = $request->all();

            $validator = Validator::make($data, [
                'email' => "required|email",
                'role_id' => "required|numeric",
                'first_name' => 'required|string',
                'last_name' => 'required|string'
            ]);

            if ($validator->fails()) {
                $notification = [
                    "title" => "Validation Errors",
                    "type" => "failed",
                    "message" => "Request Failed Validation",
                    "validationErrors" => $validator->errors(),
                ];
                // return response()->json(['notification' => $notification], 400);
            }

            $store = Store::find($request->session()->get('store_id'));
//            try {
               $notification =  StoreUser::createNew($data, $store);
//            }catch (\Exception $e) {
//                $notification = [
//                    "title" => "Could not create user",
//                    "type" => "failed",
//                    "message" => "Request Validation",
//                    "errors" => [$e->getMessage()],
//                ];
//                //Handle the exception somehow
//            }

            return redirect()->route('settings.permissions');
    }

    public function registration()
    {
        return Inertia::render('Home/StaffRegistration');
    }

    public function createStaff(Request $request)
    {
        try {
            $data = $request->all();

            $validator = Validator::make($data, [
                'email' => "required|email",
                "password" => "required|string",
                "first_name" => "required|string",
                "last_name" => "required|string",
                "token" => "required|string",
            ]);

            if ($validator->fails()) {
                $notification = [
                    "title" => "Validation Errors",
                    "type" => "failed",
                    "message" => "Request Failed Validation",
                    "validationErrors" => $validator->errors(),
                ];
                return response()->json(['notification' => $notification], 400);
            }

            $invite = Invite::where('email', $data['email'])->where('token', $data['token'])->first();

            if ($invite === null) {
                $notification = [
                    "title" => "Invalid Staff Invite",
                    "type" => "failed",
                    "message" => "This Staff Invite Link Has Expired or Does Not Exist",
                ];
                return response()->json(['notification' => $notification], 422);
            }

            $user = User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            StoreUser::create([
                'store_id' => $invite->store_id,
                'user_id' => $user->id,
                'store_group_id' => $invite->role_id,
            ]);

            $invite->delete();

            $notification = [
                "title" => "Registration Success",
                "type" => "success",
                "message" => "Your Store Account Has been Created",
            ];
            return response()->json(['notification' => $notification]);

        } catch (\Exception $e) {
            $exceptionDetails = [
                "message" => $e->getMessage(),
                'file' => basename($e->getFile()),
                'line' => $e->getLine(),
                'type' => class_basename($e),
            ];

            \Log::info("Create Staff Exception" . print_r($exceptionDetails, true));

            $notification = [
                "title" => "An Exception Occurred",
                "type" => "failed",
                "message" => "Internal Server Error",
            ];

            return response()->json(['notification' => $notification], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        //
    }
}
