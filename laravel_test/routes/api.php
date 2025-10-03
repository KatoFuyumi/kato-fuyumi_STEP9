<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

Route::post('/login',[AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/purchase',[ProductController::class,'purchaseApi']);
});