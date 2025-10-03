<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;


class LikeController extends Controller
{
    //いいね追加
    public function likeProduct(Request $request, Product $product)
    {
        $user = Auth::user();

        if(!$product->likedBy($user)) {
            Like::create([
                'product_id' => $product->id,
                'user_id' => $user->id,
            ]);
        }
        //いいねの数
        return response()->json([

        ]);
    }

    //いいね削除
    public function unlikeProduct(Request $request,Product $product)
    {
        $user = Auth::user();

        if($product->likedBy($user)) {
            Like::where('product_id',$product->id)
                ->where('user_id',$user->id)
                ->delete();
        }

        return response()->json([
        ]);
    }
}
