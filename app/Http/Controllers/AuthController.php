<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Account;

class AuthController extends Controller
{
    public function signUp(Request $request)
    {

        $validationRules = [
            "fullName" => "required|string",
            "email" => "required|email|unique:accounts",
            "password" => "required|min:6|max:12",
        ];

        $validator = Validator::make($request->all(), $validationRules);

        if ($validator->fails()) {
            return response()->json(["status" => "false", "message" => $validator->errors()->first()], 422);
        }


        try {
            $newAccount = Account::create([
                'fullName' => $request->input('fullName'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'loginWith' => 'email',

            ]);

            $token = $newAccount->createToken('auth-token')->plainTextToken;

            return response()->json(["status" => true, "message" => "account created successfully", "data" => ["token" => $token]], 201);

        } catch (\Exception $e) {

            return response()->json(["status" => false, "message" => $e->getMessage()], 500);
        }

    }

    public function login(Request $request)
    {
        $validationRules = [
            "email" => "required|email",
            "password" => "required|string"
        ];

        $validator = Validator::make($request->all(), $validationRules);

        if ($validator->fails()) {
            return response()->json(["status" => false, "message" => $validator->errors()->first()], 422);
        }

        $user = Account::where('email', $request->email)->first();
        if ($user) {

            if (Hash::check($request->password, $user->password)) {

                $token = $user->createToken('auth-token')->plainTextToken;
                return response()->json([
                    "status" => true,
                    "message" => "Logged in Successfully",
                    "data" => ["token" => $token]
                ], 200);

            } else {

                return response()->json(["status"=>false, "message"=>"Email or password is not Correct"]);
            }

        } else {

            return response()->json(["status"=>false, "message"=>"Email or password is not Correct"]);
        }
    }

}
