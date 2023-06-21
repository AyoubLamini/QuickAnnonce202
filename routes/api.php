<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VilleController;
use App\Http\Controllers\AnonnceController;
use App\Http\Controllers\CategorieController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('/getuser', [AuthController::class, 'getUser']);
    
});

Route::post('/register', [AuthController::class ,'register']);
Route::post('/login', [AuthController::class ,'login']);


Route::resource('/ville', VilleController::class);
Route::resource('/annonce', AnonnceController::class);
Route::resource('/categorie', CategorieController::class);  



