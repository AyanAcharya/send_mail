<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['middleware'=>'api','prefix'=>'auth'],function($routes){
  
    Route::post('login',[Authcontroller::class,'login']);
    Route::get('logout',[Authcontroller::class,'logout']);
    Route::get('data',[Authcontroller::class,'data_table']);
    Route::post('mail',[Authcontroller::class,'send_mail']);
    Route::post('contact_us',[Authcontroller::class,'store_data']);
    Route::post('view',[Authcontroller::class,'modal_data']);
   
});