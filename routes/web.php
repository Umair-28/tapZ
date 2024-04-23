<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/tag/{id}', [TagController::class, 'previewTag']);
Route::post('/tagLocation', [TagController::class, 'tagLocation']);
Route::post('/store-contact', [TagController::class, 'storeContact']);
Route::post('/page-scanned', [TagController::class, 'pageScanned']);