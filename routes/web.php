<?php
use App\Http\Controllers\MessageController;
use App\Http\Controllers\infocontroller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB; 
 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('sign/login');
});
Route::get('/data', function () {
    return view('sign/table');
});


 
 



