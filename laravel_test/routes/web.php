<?php

use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Models\Like;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('welcome');
});

//一覧画面
Route::get('/index',[ProductController::class,'index'])->name('index');

//商品登録
Route::get('/create',[ProductController::class,'create'])->name('create');

Route::post('/store',[ProductController::class,'store'])->name('store');

//商品詳細
Route::get('/products/{id}',[ProductController::class,'show'])->name('detail');

// 商品編集画面
Route::get('/products/{id}/edit', [ProductController::class,'edit'])->name('edit');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('update');

//検索
Route::get('/search',[ProductController::class,'search'])->name('search');

//商品削除
Route::delete('/products/{id}',[ProductController::class, 'destroy'])->name('destroy');

//ログイン
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//マイページ
Route::get('/mypage',[ProductController::class, 'mypage'])->name('mypage');

//いいね追加
Route::post('/products/{product}/like',[LikeController::class, 'likeProduct'])->middleware('auth');

//いいね削除
Route::delete('/products/{product}/like',[LikeController::class, 'unlikeProduct'])->middleware('auth');

//お問い合わせフォーム
Route::get('/contact',[ContactController::class,'showForm'])->name('contact.form');

Route::post('/contact',[ContactController::class,'submitForm'])->name('contact.submit');

//出品商品詳細
Route::get('/mypage/products/{id}',[ProductController::class,'showOwn'])->name('mypage.detail');