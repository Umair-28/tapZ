<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\OtpController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




Route::post('/account/create', [AuthController::class, 'signUp']);
Route::post('/account/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->delete('/account/delete', [AuthController::class, 'deleteAccount']);



Route::prefix('tag')->middleware(['auth:sanctum'])->group(function () {
    Route::post('/add', [TagController::class, 'addTag']);
    Route::put('/update/{id}', [TagController::class, 'updateTag']);
    Route::delete('/delete/{id}', [TagController::class, 'deleteTag']);
    Route::get('/getById/{id}', [TagController::class, 'getTagById']);
    Route::get('/getByCategory/{category}', [TagController::class, 'getTagsByCategory']);
    Route::get('/getAllTags', [TagController::class, 'getAllTags']);
  
});

Route::post('/forgot-password', [OtpController::class, 'generateOTP']);
Route::post('/reset-password', [OtpController::class, 'resetPassword']);


Route::get('/unauthenticated', function(){

    return response([
        'status'=> false,
        "message" => "unauthenticated"
    ], 401);
})->name('unauthenticated');

Route::any('{any}', function(){  // will work as fallback route 
    return response()->json([
        'status'    => false,
        'message'   => 'Route Not Found.',
    ], 404);
})->where('any', '.*');


