<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Account;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;

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
            $firstErrorMessage = $validator->errors()->first();
            return response()->json(['status' => false, 'message' => $firstErrorMessage], 400);
        }


        $tag = new Tag();
        $tag->userId = $userId;
        $data = $request->all();
        $columns = Schema::getColumnListing('tags_category');

        foreach ($data as $key => $value) {
            if (in_array($key, $columns)) {

                // Assign the value to the corresponding property if the column exists
                $tag->$key = $value;
            }
        }
        $tag->save();


        return response()->json(["status" => true, "message" => "Data inserted Successfully"]);


    }

    public function getTagsByCategory($cat)
    {
        if ($cat != "pet" && $cat != "kid" && $cat != "luggage") {
            return response()->json(["status" => false, "message" => "Category does not Exist"], 404);
        }
        $records = Tag::where('category', $cat)->get();
        $formattedData = [];
        foreach($records as $record){

            $formattedRecord = $this->formatChecker($record);
            $formattedData[] = $formattedRecord;
        }


        return response()->json(

            [
                "status" => true,
                'message' => "Data successfully fetched",
                '$data' => $formattedData
            ],
            200
        );
    }

    public function getTagById($id)
    {
        $data = Tag::where('id', $id)->first();

        if ($data) {

            $record = $this->formatChecker($data);

            return response()->json(
                [
                    "status" => true,
                    'message' => "Record Found",
                    "data" => $record
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

    public function formatChecker($record)
    {
        $record->name = strval($record->name);
        $record->ownerName = strval($record->ownerName);
        $record->fatherName = strval($record->fatherName);
        $record->brand = strval($record->brand);
        $record->luggage = strval($record->luggage);
        $record->luggageType = strval($record->luggageType);
        $record->gender = strval($record->gender);
        $record->age = intval($record->age);
        $record->reward = intval($record->reward);
        $record->height = floatval($record->height);
        $record->weight = intval($record->weight);
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


