@extends('app')

@section('title','マイページ')

@section('content')
<div class="container">
    <h1>マイページ</h1>

    <div class="d-flex mt-4">
        <a href="{{ route('account.edit') }}" class="btn btn-primary">アカウント編集</a>
    </div>

   <table class="table table-borderless">
        <tbody>
            <tr>
                <td>ユーザー名:{{ $user->name }}</td>
                <td>名前:{{ $user->name_kanji }}</td>
            </tr>
            <tr>
                <td>Eメール:{{ $user->email }}</td>
                <td>カナ:{{ $user->name_kana }}</td>
            </tr>       
        </tbody> 
   </table>

    <div class="mt-4">
    <h5>＜出品商品＞</h5>
    </div>

    <div class="d-flex">
        <a href="{{ route('create') }}" class="btn btn-primary align-items-center ms-auto gap-4 me-4">新規登録</a>
    </div>
    
    <table class=table>
        <thead>
            <tr>
                <th>商品番号</th>
                <th>商品名</th>
                <th>商品説明</th>
                <th>料金(¥)</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->price }}</td>
                <td>
                    <a href="{{ route('mypage.detail',$product->id) }}" class="btn btn-success">詳細</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">該当する商品はありません</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
    <h5>＜購入した商品＞</h5>
    </div>

    <table class=table>
        <thead>
            <tr>
                <th>商品名</th>
                <th>商品説明</th>
                <th>料金(¥)</th>
                <th>個数</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sales as $sale)
            <tr>
                <td>{{ $sale->product->product_name }}</td>
                <td>{{ $sale->product->description }}</td>
                <td>{{ $sale->product->price }}</td>
                <td>{{ $sale->quantity }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">該当する商品はありません</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection