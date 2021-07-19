<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Mail\ResetPassword;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /*
        Get started route
    */
    public function getStarted($step = null){
        switch ($step) {
            case '2':        
                return Inertia::render('Home/GetStarted-2');
                break;
            case '3':        
                return Inertia::render('Home/Tips');
                break;
            
            default:
                return Inertia::render('Home/GetStarted');
                break;
        }
    }


    public function passwordRecovery(){
        return Inertia::render('Home/PasswordRecovery');
    }

    public function changePassword(){
        return Inertia::render('Home/ChangePassword');
    }

    public function initializeStore(Request $request){
        try {
            $data = $request->all();

            $validator = Validator::make($data, [
                'store' => ['required', 'string'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'store_domain' => ['required', 'string'],
            ]);
    
            if ($validator->fails()) {
                $notification = [
                    "title" => "Validation Errors",
                    "type" => "failed",
                    "message" => "Request Failed Validation",
                    "validationErrors" => $validator->errors()
                ];
                return response()->json(['notification' => $notification ], 400);
            }

            session(['email' => $data['email']]);
            session(['store' => $data['store']]);
            session(['store_domain' => $data['store_domain']]);
            
            $notification = [
                "title" => "Store Initialized",
                "type" => "success",
                "message" => "Your Store Has Been Initialized"
            ];
            return response()->json(['notification' => $notification ]);

        } catch (\Exception $e) {
            $exceptionDetails = [
                "message" => $e->getMessage(),
                'file' => basename( $e->getFile() ),
                'line' => $e->getLine(),
                'type' => class_basename( $e ),
            ];

            \Log::info("Change Exception".print_r($exceptionDetails, true));

            $notification = [
                "title" => "An Exception Occurred",
                "type" => "failed",
                "message" => $exceptionDetails['message']
            ];

            return response()->json(['notification' => $notification ], 500);
        }
    }

    public function sendRecoveryMail(Request $request)
    {
        try {
            $email = $request->email;
            $token = Str::random(30);
            $user = User::where('email', $email)->first();

            \Log::info("Sending Mail to $email");

            if(empty($user)){
                $notification = [
                    "title" => "Not Found",
                    "type" => "failed",
                    "message" => "The mail $email does not exist please register"
                ];
                return response()->json(['notification' => $notification ], 404);
            }

            $url = config("app.url")."/auth/change-password?email=$email"."&t=$token";
                
            //change the remember_token
            $user->remember_token = $token;
            $user->save();

            Mail::to($email)->send(new ResetPassword($url));

            $notification = [
                "title" => "Mail Sent Successfully",
                "type" => "failed",
                "message" => "Password reset email has been sent to $email"
            ];
            return response()->json(['notification' => $notification ], 200);
        } catch (\Exception $e) {
            $exceptionDetails = [
                "message" => $e->getMessage(),
                'file' => basename( $e->getFile() ),
                'line' => $e->getLine(),
                'type' => class_basename( $e ),
            ];

            \Log::info("Send Recovery Mail Exception".print_r($exceptionDetails, true));

            $notification = [
                "title" => "An Exception Occurred",
                "type" => "failed",
                "message" => $exceptionDetails['message']
            ];

            return response()->json(['notification' => $notification ], 500);
        }
    }

    public function changeUserPassword(Request $request)
    {
        try {
            $data = $request->all();

            $validator = Validator::make($data, [
                'password' => ['required', 'string', 'min:6', 'confirmed'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'token' => ['required', 'string'],
            ]);
    
            if ($validator->fails()) {
                $notification = [
                    "title" => "Validation Errors",
                    "type" => "failed",
                    "message" => "Request Failed Validation",
                    "validationErrors" => $validator->errors()
                ];
                return response()->json(['notification' => $notification ], 400);
            }

            $user = User::where('email', $data['email'])->first();

            if(empty($user)){
                $notification = [
                    "title" => "Not Found",
                    "type" => "failed",
                    "message" => "The mail $data[email] does not Exist"
                ];
                return response()->json(['notification' => $notification ], 404);
            }

            if($user->remember_token !== $data['token']){
                $notification = [
                    "title" => "Invalid Token",
                    "type" => "failed",
                    "message" => "Invalid Token"
                ];
                return response()->json(['notification' => $notification ], 400);
            }

            $user->password = Hash::make($data['password']);
            $user->remember_token = '';
            $user->save();
            
            $notification = [
                "title" => "Password Changed",
                "type" => "failed",
                "message" => "Password has been changed.. Please Login"
            ];
            return response()->json(['notification' => $notification ], 200);

        } catch (\Exception $e) {
            $exceptionDetails = [
                "message" => $e->getMessage(),
                'file' => basename( $e->getFile() ),
                'line' => $e->getLine(),
                'type' => class_basename( $e ),
            ];

            \Log::info("Change Exception".print_r($exceptionDetails, true));

            $notification = [
                "title" => "An Exception Occurred",
                "type" => "failed",
                "message" => $exceptionDetails['message']
            ];

            return response()->json(['notification' => $notification ], 500);
        }
        
    }
}
