<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post("register",[StudentController::class,'Register']);
Route::post("login",[StudentController::class,'login']);


Route::group(['middleware'=>["auth:sanctum"]],function(){
    Route::get("profile",[StudentController::class,'profile']);
    Route::get("logout",[StudentController::class,'logout']);

    Route::post("create",[BookController::class,'createBook']);
    Route::get("list",[BookController::class,'ListBook']);
    Route::get("author",[BookController::class,'authorBook']);
    Route::get("single/{id}",[BookController::class,'SingleBook']);
    Route::put("update/{id}",[BookController::class,'updateBook']);
    Route::delete("delete/{id}",[BookController::class,'deleteBook']);
}); 