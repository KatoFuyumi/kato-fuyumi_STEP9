<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

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
            'product_name' => 'required|max:255',
            'description' => 'required', 
            'img_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required', 
            'stock' => 'required', 
        ]);

        $validatedData['user_id'] = auth()->id() ?? 1; // ログインユーザーID
        $validatedData['company_id'] = 1; // 仮の値
        $validatedData['product_id'] = 1; // 仮の値

        //画像ファイル処理
        if ($request->hasFile('img_path')){
            $imagePath = $request->file('img_path')->store('images','public');

            $validatedData['img_path'] = $imagePath;
        }

        //データの保存
        Product::create($validatedData);

        return redirect()->route('index')->with('success','商品が登録されました');
    }

    //商品詳細画面
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('detail',compact('product'));
    }

    //商品編集画面
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('edit',compact('product'));
    }

    //編集処理
    public function update(Request $request,$id)
    {
        $request->validate([
            'product_name' => 'required|max:255',
            'description' => 'required', 
            'img_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required', 
            'stock' => 'required', 
        ]);

        $product = Product::findOrFail($id);
        $product->product_name = $request->input('product_name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');

    //画像をアップロード
    if($request->hasFile('img_path')) {
        if($product->img_path) {
            Storage::disk('public')->delete($product->img_path);
        }

        $imagePath = $request->file('img_path')->store('images','public');
        $product->img_path = $imagePath;
    }

    $product->save();

    return redirect()->route('detail',$id)
        ->with('success','商品が更新されました');
    }

    public function search(Request $request)
    {
        $query = Product::query();
        $nameSearch = $request->input('product_name');
        $priceSearch = $request->input('price');

        if($request->filled('product_name')) {
            $query->where('product_name','like','%' . $nameSearch . '%');
        }

        $priceMin = $request->input('price_min');
        $priceMax = $request->input('price_max');

        if ($priceMin !== null) {
            $query->where('price', '>=', $priceMin);
        }

        if ($priceMax !== null) {
            $query->where('price', '<=', $priceMax);
        }

        $products = $query->get();
        return view('index',compact('products'));
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('index')
            ->with('success','商品が削除されました');
    }
}
