<?php

use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/books/{id}',[BookController::class,'getId']);
Route::get('/books',[BookController::class,'index']);
Route::post('/books',[BookController::class,'store']);
Route::put('/books/{id}', [BookController::class, 'update']);
Route::delete('/books/{id}',[BookController::class,'delete']);
Route::delete('/books',[BookController::class,'deleteAll']);