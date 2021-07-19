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
        try {
            $data = $request->all();

            $validator = Validator::make($data, [
                'email' => "required|email",
                'role_id' => "required|numeric",
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

            //check if store users already exists
            $isUser = User::where('email', $data['email'])->first();

            if ($isUser !== null) {
                $isStoreUser = StoreUser::where('user_id', $isUser->id)->where('store_id', session('store_id'))->first();
                if ($isStoreUser !== null) {
                    $notification = [
                        "title" => "Store User already Exists",
                        "type" => "failed",
                        "message" => "User with $data[email] already Exists in this Store",
                    ];
                    return response()->json(['notification' => $notification], 422);
                }

                //create store user and send a mail
                StoreUser::create([
                    'store_id' => session('store_id'),
                    'user_id' => $isUser->id,
                    'store_group_id' => $data['role_id'],
                ]);

                $store = Store::find(session('store_id'));

                Mail::to($data['email'])->send(new NewStoreUser($store->name));
    
                $notification = [
                    "title" => "User Created",
                    "type" => "success",
                    "message" => "Staff Store Account Has been Created",
                ];
                return response()->json(['notification' => $notification]);
            }

            $token = Str::random(30);

            $invite = Invite::create([
                'store_id' => session('store_id'),
                'email' => $data['email'],
                'role_id' => $data['role_id'],
                'token' => $token,
            ]);

            \Log::info("Staff Invitation Created for store" . print_r($invite, true));

            $url = config("app.url") . "/staff/registration/new?email=$data[email]" . "&t=$token";

            Mail::to($data['email'])->send(new InviteUser($url));

            $notification = [
                "title" => "Invitation Sent Successfully",
                "type" => "success",
                "message" => "Invitation email has been sent to $data[email]",
            ];
            return response()->json(['notification' => $notification]);

        } catch (\Exception $e) {
            $exceptionDetails = [
                "message" => $e->getMessage(),
                'file' => basename($e->getFile()),
                'line' => $e->getLine(),
                'type' => class_basename($e),
            ];

            \Log::info("Invite Staff Exception" . print_r($exceptionDetails, true));

            $notification = [
                "title" => "An Exception Occurred",
                "type" => "failed",
                "message" => "Internal Server Error",
            ];

            return response()->json(['notification' => $notification], 500);
        }
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
