<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['product_name','description','img_path','price','stock',
    'user_id','company_id'];

    // ログインユーザーの商品取得
    public function getOwnProduct($user_id)
    {
        $products = $this->where('user_id',$user_id)
            ->with('user')
            ->get();
        return $products;
    }

    //ログインユーザー以外の商品取得
    public function getOtherProduct($user_id)
    {
        $products = $this->where('user_id','!=',$user_id)
            ->with('user')
            ->get();
            
        return $products;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //いいねのリレーション
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function likedBy(User $user)
    {
        return $this->likes()->where('user_id',$user->id)->exists();
    }

    public function company()
    {
    return $this->belongsTo(Company::class);
    }
}
