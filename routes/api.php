<?php

use App\Http\Controllers\Api\ContactController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Routes Contact
Route::get('/contacts', [ContactController::class, 'show']);
Route::post('/contacts', [ContactController::class, 'store']);
Route::get("/contacts/{id}", [ContactController::class, "get"])->where('id', '[0-9]+');
Route::put("/contacts/{id}", [ContactController::class, "update"])->where('id', '[0-9]+');
Route::delete("/contacts/{id}", [ContactController::class, "delete"])->where('id', '[0-9]+');
