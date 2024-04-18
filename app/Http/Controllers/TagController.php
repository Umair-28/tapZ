<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Image;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Account;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Models\Connection;


class TagController extends Controller
{
    public function addTag(Request $request)
    {
        $user = Auth::user();
        // dd($user);
        $userId = $user->id;



        $validator = Validator::make($request->all(), [
            'category' => 'required|in:pet,kid,luggage',
            'name' => $request->category === 'luggage' ? "nullable" : "required|string",
            'ownerName' => $request->category === "kid" ? "nullable" : "required",
            'gender' => $request->category === 'luggage' ? "nullable" : "required|in:Male,Female",
            'age' => $request->category === 'luggage' ? "nullable" : "required",
            'medicalIssue' => $request->category === 'luggage' ? "nullable" : "string|nullable",
            'height' => $request->category === 'kid' ? "required" : "nullable",
            'weight' => $request->category === 'pet' ? "required" : "nullable",
            'color' => $request->category === 'pet' ? "required" : "nullable",
            'dressColor' => $request->category === 'kid' ? "required" : "nullable",
            'vetDetail' => $request->category === 'luggage' ? "nullable" : "string|nullable",
            'doctorDetail' => $request->category === 'luggage' ? 'nullable' : "string|nullable",
            'brand' => $request->category === 'luggage' ? "required" : "nullable",
            'luggageType' => $request->category === 'luggage' ? "required" : "nullable",
            'reward' => "required|string",
            'mobileNumber' => "required|string",
            'mobileNumber2' => "string|nullable",
            'contactEmail' => "required|email",
            'address' => "required|string",
            'note' => "string|nullable",
            'images' => 'nullable|array'

        ]);

        if ($validator->fails()) {

            // return $validator;
            return response()->json(['status' => false, 'message' => $validator->errors()->first()], 422);
        }


        $tag = new Tag();

        $data = $request->all();
        $columns = Schema::getColumnListing('tags_category');

        foreach ($data as $key => $value) {

            if (in_array($key, $columns)) {

                $tag->$key = $value;
            }
        }
        $tag->userId = $userId;
        // dd($tag);


        // Saving the Uploaded Images and their path in Database //

        if ($request->hasFile('images') && is_array($request->file('images')) && count($request->file('images')) > 0) {
            $tag->save();
            foreach ($request->file('images') as $image) {
                $imageExtension = $image->getClientOriginalExtension(); // Get the original extension of the file
                $imageName = time() . '_' . uniqid() . '.' . $imageExtension; // Append the original extension to the generated filename

                $image->move(public_path('images'), $imageName);

                // Optionally, you can create a database record for each stored image
                // For example, if you have an 'images' table with columns 'path' and 'tag_id'
                Image::create([
                    'path' => 'images/' . $imageName,
                    'tagId' => $tag->id,
                ]);
            }
        } else {
            return response()->json(['status' => false, 'message' => 'No images uploaded'], 422);
        }


        return response()->json(["status" => true, "message" => "Data inserted Successfully"]);
    }


    public function getTagsByCategory($cat)
    {
        // return $cat;
        if ($cat != "pet" && $cat != "kid" && $cat != "luggage") {
            return response()->json(["status" => false, "message" => "Category does not Exist"], 404);
        }

        $user = Auth::user();
        $userId = $user->id;

        $formattedData = [];

        // Get tags by category
        $tags = Tag::where('category', $cat)->where('userId', $userId)->get();

        if ($tags->isEmpty()) {
            return response()->json(["status" => false, "message" => "No Tags", "data" => $tags], 404);
        }

        // Loop through each tag
        foreach ($tags as $tag) {
            // Format the tag data
            $formattedRecord = $this->formatChecker($tag);

            // Get the first image for the tag
            $image = Image::where('tagId', $tag->id)->first();

            // Initialize an empty array for images
            $imagesArray = [];

            // If image exists, add its ID and URL to the images array
            if ($image) {
                $url = url($image->path);
                $imagesArray[] = [
                    'id' => $image->id,
                    'imageUrl' => $url
                ];
            }

            // Add the images array to the formatted record
            $formattedRecord['images'] = $imagesArray;

            // Add the formatted record to the formatted data array
            $formattedData[] = $formattedRecord;
        }

        return response()->json(
            [
                "status" => true,
                'message' => "Data successfully fetched",
                'data' => $formattedData,
            ],
            200
        );
    }


    public function getTagById($id)
    {
        $data = Tag::where('id', $id)->first();

        if ($data) {
            $imagesArray = [];
            $images = Image::where('tagId', $data->id)->get();

            foreach ($images as $img) {
                if ($img->path != "") {
                    $url = url($img->path);
                    $imagesArray[] = [
                        'id' => $img->id,
                        'imageUrl' => $url
                    ];
                }
            }

            $record = $this->formatChecker($data);
            $record['images'] = $imagesArray;

            return response()->json(
                [
                    "status" => true,
                    'message' => "Record Found",
                    "data" => $record,
                    //"images" => $imagesArray
                ],
                200
            );
        }

        return response()->json(
            [
                "status" => false,
                'message' => "Record Not Found"
            ],
            404
        );
    }



    public function getAllTags(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;
        $data = Tag::where('userId', $userId)->get();

        $kidArray = [];
        $petArray = [];
        $luggageArray = [];

        foreach ($data as $record) {
            $record = $this->formatChecker($record);
            $image = Image::where('tagId', $record->id)->first();

            $recordData = [
                'id' => $record->id,
                'category' => $record->category,
                'name' => $record->name,
                'ownerName' => $record->ownerName,
                'fatherName' => $record->fatherName,
                'gender' => $record->gender,
                'age' => $record->age,
                'medicalIssue' => $record->medicalIssue,
                'height' => $record->height,
                'weight' => $record->record,
                'color' => $record->color,
                'dressColor' => $record->dressColor,
                'vetDetail' => $record->vetDetail,
                'brand' => $record->brand,
                'luggageType' => $record->luggageType,
                'reward' => $record->reward,
                'mobileNumber' => $record->mobileNumber,
                'mobileNumber2' => $record->mobileNumber2,
                'contactEmail' => $record->contactEmail,
                'address' => $record->address,
                'note' => $record->note,

                // Add other fields from $record as needed
                'images' => []
            ];

            if ($image) {
                $recordData['images'][] = [
                    'id' => $image->id,
                    'imageUrl' => url($image->path)
                ];
            }

            // Add the record data to the respective category array
            if ($record->category === 'kid') {
                $kidArray[] = $recordData;
            } elseif ($record->category === 'pet') {
                $petArray[] = $recordData;
            } elseif ($record->category === 'luggage') {
                $luggageArray[] = $recordData;
            }
        }

        $combinedData = [
            "kid" => $kidArray,
            "pet" => $petArray,
            "luggage" => $luggageArray
        ];

        return response()->json(
            [
                "status" => true,
                'message' => "Data successfully fetched",
                'data' => $combinedData
            ],
            200
        );
    }


    public function updateTag(Request $request, $id)
    {    
        // return $request->all();
        $user = Auth::user();
        $userId = $user->id;
        if(!$user){
            return response()->json(["status"=>false, "message"=>"Not Authorized"]);
        }; 
        $userId = $user->id;

        
        $validator = Validator::make($request->all(), [
            'category' => 'required|in:pet,kid,luggage',
            'name' => $request->category === 'luggage' ? "nullable" : "required|string",
            'ownerName' => $request->category === "kid" ? "nullable" : "required|string",
            'gender' => $request->category === 'luggage' ? "nullable" : "required|in:Male,Female",
            'age' => $request->category === 'luggage' ? "nullable" : "required",
            'medicalIssue' => $request->category === 'luggage' ? "nullable" : "required|string",
            'height' => $request->category === 'kid' ? "required" : "nullable",
            'weight' => $request->category === 'pet' ? "required" : "nullable",
            'color' => $request->category === 'pet' ? "required" : "nullable",
            'dressColor' => $request->category === 'kid' ? "required" : "nullable",
            'vetDetail' => $request->category === 'pet' ? "required" : "nullable",
            'brand' => $request->category === 'luggage' ? "required" : "nullable",
            'luggageType' => $request->category === 'luggage' ? "required" : "nullable",
            'reward' => "required|string",
            'mobileNumber' => "required|string",
            'mobileNumber2' => "string|nullable",
            'contactEmail' => "required|email",
            'address' => "required|string",
            'note' => "string|nullable",


        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "message" => $validator->errors()->first()
            ], 422);
        }

        $tag = Tag::find($id);
        if (!$tag) {
            return response()->json([
                "status" => false,
                "message" => "Tag Not Found",
            ], 404);
        }

        // return $userId;
        $request->userId = $userId;
       
        // return $request;
        $data = $request->all();
        foreach($data as $key=>$value)
        {
            if($key == "images")
            {
                continue;
            }
            $tag->$key = $value;
        }
        $tag->userId = $userId;
        $tag->save();
        // return $tag;

        // $tag->update($request->except('images')); // Update tag fields except images

        // if(count($request->images) > 0)
        // {


        // Handle image updates
        // $updatedImageIds = [];
        // $imageData = $request->input('images', []);

        // foreach ($imageData as $image) {
        //     $imageId = $image['id'];
        //     if ($imageId == 0) {
        //         // New image: Store it and associate it with the tag
        //         $fileName = time() . '_' . $image->getClientOriginalName();
        //         $image->move(public_path('images'), $fileName);

        //         $newImage = Image::create([
        //             'path' => 'images/'.$fileName,
        //             'tagId' => $tag->id,
        //         ]);
        //         $updatedImageIds[] = $newImage->id;
        //     } 
        // }

        // // Delete images not in the updated list
        // $existingImages = Image::where('tagId', $tag->id)->pluck('id');
        // $imagesToDelete = $existingImages->diff($updatedImageIds);
        // Image::whereIn('id', $imagesToDelete)->delete();
//}

        if ($request->hasFile('images') && is_array($request->file('images')) && count($request->file('images')) > 0) {
            $tag->save();
            foreach ($request->file('images') as $image) {
                $imageExtension = $image->getClientOriginalExtension(); // Get the original extension of the file
                $imageName = time() . '_' . uniqid() . '.' . $imageExtension; // Append the original extension to the generated filename

                $image->move(public_path('images'), $imageName);

                // Optionally, you can create a database record for each stored image
                // For example, if you have an 'images' table with columns 'path' and 'tag_id'
                Image::create([
                    'path' => 'images/' . $imageName,
                    'tagId' => $tag->id,
                ]);
            }
        }
        return response()->json([
            "status" => true,
            "message" => "Tag updated successfully",
        ], 200);
    }

    public function deleteTag($id)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(["status" => false, "message" => "Unauthorized"], 401);
        }
        $tag = Tag::where('id', $id)
            ->where('userId', $user->id)
            ->first();
        if ($tag) {
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
            return response()->json([
                "status" => true,
                "message" => "Record Deleted Successfully"
            ], 200);
        }

        return response()->json([
            "status" => false,
            "message" => " Record Not Found"
        ]);
    }

    public function formatChecker($record)
    {
        $record->name = strval($record->name);
        $record->ownerName = strval($record->ownerName);
        $record->fatherName = strval($record->fatherName);
        $record->brand = strval($record->brand);
        $record->luggage = strval($record->luggage);
        $record->luggageType = strval($record->luggageType);
        $record->gender = strval($record->gender);
        $record->age = strval($record->age);
        $record->reward = strval($record->reward);
        $record->height = strval($record->height);
        $record->weight = strval($record->weight);
        $record->dressColor = strval($record->dressColor);
        $record->color = strval($record->color);
        $record->mobileNumber = strval($record->mobileNumber);
        $record->mobileNumber2 = strval($record->mobileNumber2);
        $record->contactEmail = strval($record->contactEmail);
        $record->address = strval($record->address);
        $record->doctorDetail = strval($record->doctorDetail);
        $record->vetDetail = strval($record->vetDetail);
        $record->medicalIssue = strval($record->medicalIssue);
        $record->note = strval($record->note);
        $record->category = strval($record->category);
        $record->userId = strval($record->userId);

        return $record;

    }

    public function previewTag($id)
    {
        $tag = Tag::find($id);
        if ($tag) {
            $images = Image::where('tagId', $tag->id)->get();
            $image = Image::where('tagId', $tag->id)->first();
    
            // Check if images exist
            if ($images->isEmpty()) {
                // No images found, handle this case as needed
                return view('noImagesFound', compact('tag'));
            }
            
  
          
            return view('previewTag', compact('tag','images','image'));
        } else {
            return view('notFound');
        }
    }

    public function deleteImage(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(["status" => false, "message" => "Not Authorized"],401);
        }
        
        $image = Image::where('id', $id)->first();
        if ($image) {
            // Delete the image record from the database
            $image->delete();

            // Delete the corresponding image file from the public directory
            $imagePath = public_path($image->path); // Assuming 'path' is the column containing the image path
            if (file_exists($imagePath)) {
                unlink($imagePath); // Delete the file
            }
            return response()->json(['status' => true, 'message' => 'Image deleted successfully'], 200);
        }
        return response()->json(["status" => false, "message" => "Image not Found"], 404);
    }

    public function deleteUserImage(Request $request){



        $user = Auth::user();
        if (!$user) {
            return response()->json(["status" => false, "message" => "Not Authorized"],401);
        }
        
        $image = Image::where('userId', $user->id)->first();
        if ($image) {
            // Delete the image record from the database
            $image->delete();

            // Delete the corresponding image file from the public directory
            $imagePath = public_path($image->path); // Assuming 'path' is the column containing the image path
            if (file_exists($imagePath)) {
                unlink($imagePath); // Delete the file
            }
            return response()->json(['status' => true, 'message' => 'Image deleted successfully'], 200);
        }
        return response()->json(["status" => false, "message" => "Image not Found"], 404);

    }

    public function updateAccount(Request $request){

       
        $user = Auth::user();

        if (!$user) {
            return response()->json(["status" => false, "message" => "Not Authorized"],401);
        }

        $validationRules = [
            
            "fullName" => "string",

        ];
        $accessToken = $user->currentAccessToken();

        $validator = Validator::make($request->all(), $validationRules);

        if ($validator->fails()) {
            return response()->json(["status" => false, "message" => $validator->errors()->first()], 422);
        }

        $user->update([
            
            'fullName'=>$request->fullName
        ]);
        $user->save();


        
       

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageExtension = $image->getClientOriginalExtension(); // Get the original extension of the file
            $imageName = time() . '_' . uniqid() . '.' . $imageExtension; // Append the original extension to the generated filename
    
            $image->move(public_path('images'), $imageName);

            Image::create([
                'path' => 'images/' . $imageName,
                'userId' => $user->id,
            ]);
        }

        $images = Image::where('userId', $user->id)->get();

        if($images){
            foreach ($images as $img) {
                if ($img->path != "") {
                    $url = url($img->path);
                    $user->userImage  = $url;
                  
                }
            }
        }
        $token = $request->bearerToken();
        $user->token = $token;
      
       

        return response()->json(["status" => true, "message" => "Account updated successfully", "data"=>$user], 200);
    }

    public function tagLocation(Request $request){

            $tag_category =  $request->tag_category;

            $latitude = $request->lat;
            $longitude = $request->lng;
            $address = $request->address;
            $userId = $request->userId;
            $tagId = $request->tagId;
            $fcmToken = Account::where('id',$request->userId)->value('fcmToken');
                

        // FCM API Url
        $url = 'https://fcm.googleapis.com/fcm/send';

        // Put your Server Key here
        $apiKey = "AAAAaqsOano:APA91bEOzteQsyRTPwUJYVwg63oJNjlPvT6gxPttNojm7Ybohxv2W5u0uIKceg976U_M2ueTPyg9YvGIfL341DyvURDsRWLyCdtT13Q631wtwZjfJ3I9wrVZRAEJA_gm8AlAXE8rE2gg";

        // Compile headers in one variable
        $headers = array(
            'Authorization:key=' . $apiKey,
            'Content-Type:application/json'
        );
        $message = "Your tag has been Found";
        
        // Add notification content to a variable for easy reference
        $notifData = [
            'title' => "Tag Found",
            'body' => $message,
            "sound" => "default",
            //  "image": "url-to-image",//Optional
            // 'click_action' => "activities.NotifHandlerActivity" //Action/Activity - Optional
        ];

        $dataPayload = [
            'to' => 'My Name',
            'points' => 80,
            'address' => $address,
            'tagId' => $tagId,
            'tag_category' => $tag_category,

        ];

      

        // Create the api body
        $apiBody = [
            'notification' => $notifData,
            'data' => $dataPayload, //Optional
            'time_to_live' => 600, // optional - In Seconds
            //'to' => '/topics/mytargettopic'
            //'registration_ids' = ID ARRAY
            'to' => $fcmToken,
        ];
        // Initialize curl with the prepared headers and body
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($apiBody));

        // Execute call and save result
        $result = curl_exec($ch);
        // Close curl after call
        curl_close($ch);
        if ($result) {

            $notification = Notification::create([
                'address' => $address,
                'userId' => $userId,
                'tagId' => $tagId,
                'latitude'=>$latitude,
                'longitude'=>$longitude,
                'tag_category' => $tag_category
            ]);
            return $result;
        }else{
            return response()->json(["status"=>false, "message"=>"Error Saving Message in Mysql"]);
        }
    

    }//function bracket

    public function getNotifications(){

        $user = Auth::user();

        if (!$user) {
            return response()->json(["status" => false, "message" => "Not Authorized"],401);
        }


        
        $data = Notification::where('userId',$user->id)->get();

        if($data->isEmpty()){
            return response()->json(["status"=>true, "message"=>"No notifications for this user"],404);
        }

        return response()->json(["status"=>true, "message"=>"Notifications found", "data"=>$data]);    
    }

    public function storeContact(Request $request){
        
        $connection = Connection::create($request->all());
    }

    public function getContacts(Request $request){

        $user = Auth::user();

        if (!$user) {
            return response()->json(["status" => false, "message" => "Not Authorized"],401);
        }


        
        $data = Connection::where('userId',$user->id)->get();

        if($data->isEmpty()){
            return response()->json(["status"=>true, "message"=>"No one contacted you yet"],404);
        }

        return response()->json(["status"=>true, "message"=>"Some contacted you ", "data"=>$data],200);   
    }


}





