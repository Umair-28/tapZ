<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use App\Models\Account;
use Illuminate\Support\Facades\Hash; // Add this at the top

class OtpController extends Controller
{
    public function generateOTP(Request $request){

        $rules = [
            'email' => 'required|email|exists:accounts,email'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json(['status' => false, 'message' => $validator->error()->first()], 422);
        }

        $inputEmail = $request->input('email');
        $user = Account::where("email",$inputEmail)->first();
        $userName = $user->fullName;
        $userEmail = $user->email;
        // dd($user);

        $otp = rand(100000, 999999);

        // Save OTP to the user
         $user->otp = $otp;
         $user->save();

         Mail::to($userEmail)->send(new OtpMail($userName, $otp));

         return response()->json(["status"=>true, "message"=> "OTP successfully saved and Email is sent"]);
      
    }



    public function resetPassword(Request $request)
    {
        $rules = [
            'email' => 'required|email|exists:accounts,email',
            'otp' => 'string|required',
            'password' => "required|min:6|max:12",
        ];
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return response()->json(["status" => false, "message" => $validator->errors()->first()], 422);
        }
    
        $user = Account::where("email", $request->email)->first();
    
        if (!$user) {
            return response()->json(["status" => false, "message" => "User not found"], 404);
        }
    
        if ($user->otp === $request->otp) {
            $user->otp = null; // Clear the OTP
            $user->password = Hash::make($request->password); // Hash the new password
            $user->save();
    
            return response()->json(["status" => true, "message" => "Password updated successfully"]);
        }
    
        return response()->json(["status" => false, "message" => "OTP does not match"], 422);
    }
    

}
