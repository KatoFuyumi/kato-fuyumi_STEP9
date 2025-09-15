<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Models\Product;

Route::get('/', function () {
    return view('welcome');
});

//一覧画面
Route::get('/index',[ProductController::class,'index'])->name('index');

//商品登録
Route::get('/create',[ProductController::class,'create'])->name('create');

Route::post('/store',[ProductController::class,'store'])->name('store');

//商品詳細
Route::get('/product/{id}',[ProductController::class,'show'])->name('detail');