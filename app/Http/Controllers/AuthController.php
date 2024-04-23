<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Tag;
use App\Models\Account;
use Illuminate\Support\Facades\File;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function signUp(Request $request)
    {

        $validationRules = [
            "fullName" => "required|string",
            "email" => "required|email|unique:accounts",
            "password" => "required|min:6|max:12",
            "platform" => "required|string",
            "loginWith" => "required| in:facebook,google,email",
            "fcmToken" => "required|string"
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
                'loginWith' => $request->input('loginWith'),
                "platform" => $request->input('platform'),
                "fcmToken" => $request->input('fcmToken')

            ]);
            $userData = $newAccount->makeHidden(['password', 'updated_at', 'otp'])->toArray();

            $token = $newAccount->createToken('auth-token')->plainTextToken;
            $userData['googleId'] = $newAccount->googleId ?? '';
            $userData['facebookId'] = $newAccount->facebookId ?? '';
            $userData['appleId'] = $newAccount->appleId ?? '';

            $userData['token']=$token;

            return response()->json(["status" => true, "message" => "account created successfully", "data" => $userData], 201);

        } catch (\Exception $e) {

            return response()->json(["status" => false, "message" => $e->getMessage()], 500);
        }

    }

    public function login(Request $request)
    {
        $validationRules = [
            "email" => "required|email",
            "platform" => "required|string",
            "loginWith" => "required|in:facebook,google,email",
            "fcmToken" => "required|string"
        ];

        $validator = Validator::make($request->all(), $validationRules);

        if ($validator->fails()) {
            return response()->json(["status" => false, "message" => $validator->errors()->first()], 422);
        }

        if($request->loginWith != "email")
        {
           return $this->socialLogin($request);
        }

        $validationRules = [
            
            "password" => "required|string",
            
        ];

        $validator = Validator::make($request->all(), $validationRules);

        if ($validator->fails()) {
            return response()->json(["status" => false, "message" => $validator->errors()->first()], 422);
        }



        $user = Account::where('email', $request->email)->first();
        if ($user) {

            if (Hash::check($request->password, $user->password)) {

                $token = $user->createToken('auth-token')->plainTextToken;
                $userData = $user->makeHidden(['password', 'updated_at', 'otp'])->toArray();
                
                $user->update([
                    'platform'=>$request->input('platform'),
                    'fcmToken' => $request->input('fcmToken'),  
                    'loginWith' => $request->input('loginWith')
                ]);
                
                $image = Image::where('userId',$user->id)->get();
                
                foreach ($image as $img) {
                    if ($img->path != "") {
                        $url = url($img->path);
                        $user->userImage  = $url;
                        $user->save();
                      
                    }
                }
               
                
                $userData['token'] = $token;
               

                
                
                return response()->json([
                    "status" => true,
                    "message" => "Logged in Successfully",
                    "data" => $userData
                ], 200);

            } else {

                return response()->json(["status"=>false, "message"=>"Password does not matched"],401);
            }

        } else {

            return response()->json(["status"=>false, "message"=>"Email not found"],401);
        }
    }
    public function socialLogin(Request $request)
        {
            if($request->socialId == null){
                return response()->json(["status"=>false,"message"=>"socialId is required"]);
            }

            $account = Account::where('email',$request->email)->first();
            
            if($account){

                $account->loginWith = $request->loginWith; 
                $account->fcmToken = $request->fcmToken;
                $account->platform = $request->platform; 

                if($request->loginWith === 'google'){
                    $account->googleId = $request->socialId;
                }
                elseif($request->loginWith === 'facebook'){
                    $account->facebookId = $request->socialId;
                }

                $images = Image::where('userId', $account->id)->get();

                if($images){
                    foreach ($images as $img) {
                        if ($img->path != "") {
                            $url = url($img->path);
                            $account->userImage  = $url;
                          
                        }
                    }
                }

                

                $account->save();
            }else{
                
                $account = Account::create([
                    'fullName' => $request->fullName,
                    'email' => $request->email,
                    'password' => Hash::make(Str::random(8)),
                    'googleId' => $request->loginWith == "google" ? $request->socialId : "",
                    'facebookId' => $request->loginWith == "facebook" ? $request->socialId : "",
                    'loginWith' => $request->loginWith, 
                    'fcmToken' => $request->fcmToken,
                    'platform' => $request->platform, 
    
                ]);
               
                
            }

            $token = $account->createToken('auth-token')->plainTextToken;
                $userData = $account;
                $userData['token'] = $token;

            return response()->json(["status"=>true, "message"=>'Logged in successfully', "data"=>$userData],200);



        }
    public function deleteAccount(){

        $user = Auth::user();
        $authId = Auth::Id();
        if(!$user){
            return response()->json(["status"=>false, "message"=>"Not Authorized"],401);
        }

        $account = Account::find($authId);
        if($account){
            $tags = Tag::where('userId',$account->id)->get();

            foreach($tags as $tag){
            $tagImages = Image::where("tagId", $tag->id)->get();
            foreach ($tagImages as $image) {
                $imagePath = public_path('images/' . basename($image->path));
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
                
                // Delete the image record from the database
                $image->delete();
            }
                $tag->delete();
            }

            $account->delete();

            return response()->json(['status' => true, 'message' => 'Account, associated images and tags are deleted successfully'],200);
        }

        return response()->json(["status"=>false, "message"=> "user not found"],404);
    }

}
