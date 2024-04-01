<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Image;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\Models\Account;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;


class TagController extends Controller
{
    public function addTag(Request $request)
    {
        $user = $request->user();
        $userEmail = $user->email;

        $account = Account::where('email', $userEmail)->first();
        $userId = $account->id;

        $validator = Validator::make($request->all(), [
            'category' => 'required|in:pet,kid,luggage',
            'name' => $request->category === 'luggage' ? "nullable" : "required|string",
            'ownerName' => $request->category === "kid" ? "nullable" : "required",
            'gender' => $request->category === 'luggage' ? "nullable" : "required|in:male,female",
            'age' => $request->category === 'luggage' ? "nullable" : "required",
            'medicalIssue' => $request->category === 'luggage' ? "nullable" : "required",
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
            'note' => "string|nullable"

        ]);

        if ($validator->fails()) {
        
            return response()->json(['status' => false, 'message' => $validator->error()->first()], 422);
        }

        $tag = new Tag();
        $tag->userId = $userId;
        $data = $request->all();
        $columns = Schema::getColumnListing('tags_category');

        foreach ($data as $key => $value) {

            if (in_array($key, $columns)) {

                $tag->$key = $value;
            }
        }

        $tag->save();

        // Saving the Uploaded Images and their path in Database //

        foreach($request->images as $image)
        {
            $fileName = Str::random(8) . '_' . time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('uploads', $fileName, 'public');

             Image::create([
                'path' => $path,
                'tagId' => 1,
           ]);
        }

        return response()->json(["status" => true, "message" => "Data inserted Successfully"]);
    }

    public function getTagsByCategory($cat)
    {
        if ($cat != "pet" && $cat != "kid" && $cat != "luggage") {
            return response()->json(["status" => false, "message" => "Category does not Exist"], 404);
        }
    
        $formattedData = [];
        $imagesArray = [];
    
        // Get tags by category
        $tags = Tag::where('category', $cat)->get();
    
        // Loop through each tag
        foreach ($tags as $tag) {
            // Format the tag data
            $formattedRecord = $this->formatChecker($tag);
            $formattedData[] = $formattedRecord;
    
            // Get the first image for the tag
            $image = Image::where('tagId', $tag->id)->first();
    
            // If image exists, add its URL to the images array
            if ($image) {
                $storagePath = $image->path;
                $url = url('storage/' . $storagePath);
                $imagesArray[] = $url;
            } else {
                // If no image found, add null to the images array
                $imagesArray[] = null;
            }
        }
    
        return response()->json(
            [
                "status" => true,
                'message' => "Data successfully fetched",
                '$data' => $formattedData,
                'image' => $imagesArray
            ],
            200
        );
    }
    

    public function getTagById($id)
    {
        $data = Tag::where('id', $id)->first();
    
        if ($data) {
            $imagesArray = [];
            $images = Image::where('tagId',$data->id)->get();
            foreach($images as $img)
            {
                if($img->path != "")
                {
                    $storagePath =  $img->path;
                    $url = url('storage/' . $storagePath);
                    //dd($url);
                    // Add the URL to the images array
                    $imagesArray[] = $url;
            }
            $record = $this->formatChecker($data);

            return response()->json(
                [
                    "status" => true,
                    'message' => "Record Found",
                    "data" => $record,
                    "images" => $imagesArray

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
}

    public function getAllTags()
    {
        $data = Tag::all();

        $kidArray = [];
        $petArray = [];
        $luggageArray = [];

        foreach ($data as $record) {

            $record = $this->formatChecker($record);

            if ($record->category === 'kid') {
                $kidArray[] = $record;
            } elseif ($record->category === 'pet') {
                $petArray[] = $record;
            } else {
                $luggageArray[] = $record;
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


    public function updateTag(Request $request, $id){

        $user = $request->user();
        $userEmail = $user->email;

        $account = Account::where('email', $userEmail)->first();
        $userId = $account->id;

        
        $validator = Validator::make($request->all(), [
            'category' => 'required|in:pet,kid,luggage',
            'name' => $request->category === 'luggage' ? "nullable" : "required|string",
            'ownerName' => $request->category === "kid" ? "nullable" : "required",
            'gender' => $request->category === 'luggage' ? "nullable" : "required|in:male,female",
            'age' => $request->category === 'luggage' ? "nullable" : "required",
            'medicalIssue' => $request->category === 'luggage' ? "nullable" : "required",
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
            'note' => "string|nullable"

        ]);

        
        if($validator->fails()){
            return response()->json([
                "status" => false,
                "message" => $validator->errors()->first()
            ]);
        }

        $tag = Tag::where('id', $id)->first();
        if($tag){
            $tag->userId = $userId;
            $tag->update($request->all());

            return response()->json([
                "status" => true,
                "message" => "Tag updated successfully",
            ], 200);
        }

        return response()->json([
            "status" => false,
            "message" => "Tag Not Found",
        ],404);
    }

    
    public function deleteTag($id){
        $tag = Tag::find($id);
        if($tag){
            $tag->delete();
            return response()->json([
                "status" => true,
                "message" => "Record Deleted Successfully"
            ],200);
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


}


