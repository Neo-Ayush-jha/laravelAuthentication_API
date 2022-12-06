<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

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

Route::post('/register',[StudentController::class,'resister']); 
Route::post('/login',[StudentController::class,'login']); 
Route::post('/profile',[StudentController::class,'profile']); 
Route::post('/refresh',[StudentController::class,'refresh']); 
Route::post('/logout',[StudentController::class,'logout']); 