<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    //一覧画面
    public function index()
    {
        $products = Product::all();

        return view('index',compact('products'));
    }

    //商品新規登録
    public function create()
    {
        return view('create');
    }

    //登録データを保存
    public function store(ProductRequest $request)
    {
        //バリデーション
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'content' => 'required', 
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required', 
        ]);

        //画像ファイル処理
        if ($request->hasFile('image')){
            $imagePath = $request->file('image')->store('images','public');
            $validatedData['image'] = $imagePath;
        }

        //データの保存
        Product::create($validatedData);

        return redirect()->route('index')->with('success','商品が登録されました');
    }
}
