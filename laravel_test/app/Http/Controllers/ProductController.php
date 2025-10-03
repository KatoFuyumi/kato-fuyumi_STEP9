<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\React;
use App\Models\Company;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    //一覧画面
    public function index()
    {
        $products = Product::all();

        return view('index',compact('products'));
    }

    //コンストラクタ
    public function __construct(
        private Product $product = new Product,
    ) {}

    //マイページ
    public function mypage()
    {
        //ログインユーザーID取得
        $user_id = Auth::id();
        //自身の商品取得
        $products = $this->product->getOwnProduct($user_id);
        //ビューにデータを渡す
        $user = Auth::user();

        //購入品一覧
        $sales = $user->sales()->with('product')->get();
        return view('mypage', compact('products','user','sales'));
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
        $validatedData = $request->validate();

        //画像ファイル処理
        if ($request->hasFile('img_path')){
            $imagePath = $request->file('img_path')->store('images','public');

            $validatedData['img_path'] = $imagePath;
        }

        $validatedData['user_id'] = auth()->id();
        $validatedData['company_id'] = 1; 

        //データの保存
        $product = Product::create($validatedData);

        return redirect()->route('mypage')->with('success','商品が登録されました');
    }

    //商品詳細画面、会社名表示
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $company = Company::findOrFail($product->company_id);

        return view('detail', compact('product', 'company'));
    }

    //商品編集画面
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('edit',compact('product'));
    }

    //編集処理
    public function update(ProductRequest $request,$id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validated();

    //画像をアップロード
    if($request->hasFile('img_path')) {
        if($product->img_path) {
            Storage::disk('public')->delete($product->img_path);
        }

        $imagePath = $request->file('img_path')->store('images','public');
        $product->img_path = $imagePath;
    }

    $product->save();
    $product->fill($data);

    return redirect()->route('mypage.detail',$product->id)
        ->with('success','商品が更新されました');
    }

    //検索
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

        return redirect()->route('mypage')
            ->with('success','商品が削除されました');
    }

    //出品商品詳細
    public function showOwn($id)
    {
        $product = Product::findOrFail($id);
        return view('mypage.detail_own',compact('product'));
    }

    //商品購入画面
    public function showPurchaseForm($product_id)
    {
        $product = Product::with('company')->findOrFail($product_id);
        return view('purchase',compact('product'));
    }

    //購入処理
    public function purchaseWeb(Request $request)
    {
      
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');

        $product = Product::find($product_id);

        if (!$product) {
            return redirect()->back()->with(['error'=>'商品が見つかりません']);
        }
        
        if($product->stock < $quantity) {
            return redirect()->back()->with(['error'=>'在庫が不足しています。']);
        }

        DB::beginTransaction();
        try {
            $sale = Sale::create([
                'user_id' => Auth::id(),
                'product_id' => $product_id,
                'quantity' => $quantity
            ]);

        $product->decrement('stock',$quantity);
        DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error'=>'購入に失敗しました。']);
        }

        return redirect()->route('index')->with(['success' => '購入が完了しました！']);
    }

    public function purchaseApi(Request $request)
    {
      
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');

        $product = Product::find($product_id);

        if (!$product) {
            return response()->json(['error'=>'商品が見つかりません'], 404);
        }
        
        if($product->stock < $quantity) {
            return response()->json(['error'=>'在庫が不足しています。'],400);
        }

        DB::beginTransaction();
        try {
            $sale = Sale::create([
                'user_id' => Auth::id(),
                'product_id' => $product_id,
                'quantity' => $quantity
            ]);

        $product->decrement('stock',$quantity);
        DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error'=>'購入に失敗しました。'],500);
        }

        return response()->json(['message' => '購入が完了しました！','order'   => $sale,], 201);
    }
  
}
