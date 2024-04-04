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
use Illuminate\Support\Facades\Auth;


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
            'gender' => $request->category === 'luggage' ? "nullable" : "required|in:male,female",
            'age' => $request->category === 'luggage' ? "nullable" : "required",
            'medicalIssue' => $request->category === 'luggage' ? "nullable" : "required",
            'height' => $request->category === 'kid' ? "required" : "nullable",
            'weight' => $request->category === 'pet' ? "required" : "nullable",
            'color' => $request->category === 'pet' ? "required" : "nullable",
            'dressColor' => $request->category === 'kid' ? "required" : "nullable",
            'vetDetail' => $request->category === 'pet' ? "required" : "nullable",
            'doctorDetail' => $request->category === 'kid' ? 'required' :"nullable",
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
        $tag->save();

        // Saving the Uploaded Images and their path in Database //

        // if ($request->hasFile('images') && is_array($request->file('images')) && count($request->file('images')) > 0) {
        if ($request->images) {

            // foreach ($request->images as $image) {
            //     // Validate each image
            //     $validator = Validator::make(
            //         ['image' => $image],
            //         ['image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'] // Adjust the validation rules as needed
            //     );

            //     if ($validator->fails()) {
            //         // Handle validation errors
            //         return response()->json(['status' => false, 'message' => "image validation fails"], 422);
            //     }
            // }

            // All images are valid, proceed to store them
            foreach ($request->images as $image) {

                $fileName = Str::random(8) . '_' . time() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('uploads', $fileName, 'public');

                // Create a database record for each stored image
                Image::create([
                    'path' => $path,
                    'tagId' => $tag->id,
                ]);
            }
        } else {
            // Handle if no images were uploaded
            return response()->json(['status' => false, 'message' => 'No images uploaded'], 422);
        }


        return response()->json(["status" => true, "message" => "Data inserted Successfully"]);
    }


    public function getTagsByCategory($cat)
    {
        if ($cat != "pet" && $cat != "kisd" && $cat != "luggage") {
            return response()->json(["status" => false, "message" => "Category does not Exist"], 404);
        }

        $formattedData = [];

        // Get tags by category
        $tags = Tag::where('category', $cat)->get();

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
                $storagePath = $image->path;
                $url = url('storage/' . $storagePath);
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
                    $storagePath = $img->path;
                    $url = url('storage/' . $storagePath);
                    $imagesArray[] = [
                        'id' => $img->id,
                        'imageUrl' => $url
                    ];
                }
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


    public function getAllTags(){
    $data = Tag::all();

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
                'imageUrl' => url('storage/' . $image->path)
            ];
        }

        // Add the record data to the respective category array
        if ($record->category === 'kid') {
            $kidArray[] = $recordData;
        } elseif ($record->category === 'pet') {
            $petArray[] = $recordData;
        } else {
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
        $user = Auth::user();
        $userId = $user->id;

        // return $request;


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
            return response()->json([
                "status" => false,
                "message" => $validator->errors()->first()
            ]);
        }

        $tag = Tag::where('id', $id)->first();
        if ($tag) {
            $tag->userId = $userId;
            $tag->update($request->all());

            // Fetch all existing images related to the tag
            $existingImages = Image::where('tagId', $tag->id)->get()->keyBy('id');

            $imageData = $request->input('images', []);
            $updatedImageIds = [];

            // [

                    //     {
                    //         "id": 12
                    //         "image": "qwertywerty"
                    //     },
                    //     {
                    //         "id": 21
                    //         "image": "awqeqrqwr"
                    //     },
                    //     {
                    //         "id": 0
                    //         "image": "file"
                    //     }
                    //     {
                    //         "id": 22
                    //         "image": "asdawafawf"
                    //     }
               // ]
            $imagesToDelete = $existingImages->keys()->diff($updatedImageIds);
            Image::whereIn('id', $imagesToDelete)->delete();

            foreach ($imageData as $image) {
                $imageId = $image['id'];

                if ($imageId == 0) {
                    // New image: Store it and associate it with the tag
                    $fileName = Str::random(8) . '_' . time() . '.' . $image['image']->getClientOriginalExtension();
                    $path = $image['image']->storeAs('uploads', $fileName, 'public');

                    $newImage = Image::create([
                        'path' => $path,
                        'tagId' => $tag->id,
                    ]);
                    $updatedImageIds[] = $newImage->id;
                }

            }

            return response()->json([
                "status" => true,
                "message" => "Tag updated successfully",
            ], 200);
        }

        return response()->json([
            "status" => false,
            "message" => "Tag Not Found",
        ], 404);
    }


    public function deleteTag($id)
    {
        $user = Auth::user();
        if(!$user){
            return response()->json(["status"=>false, "message"=>"Unauthorized"],401);
        }
        $tag = Tag::where('id', $id)
        ->where('userId', $user->id)
        ->first();
        if ($tag) {
            $tagImages = Image::where("tagId", $tag->id)->get();
            foreach($tagImages as $image){
                Storage::delete('public/uploads/'. basename($image->path));
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


}





