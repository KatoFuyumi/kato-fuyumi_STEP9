@extends('app')

@section('title','マイページ')

@section('content')
<div class="container">
    <h1>マイページ</h1>

    <div class="d-flex mb-3">
        <a href="{{ route('account.edit') }}" class="btn btn-primary mb-3">アカウント編集</a>
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

    <h5>＜出品商品＞</h5>

    <div class="d-flex mb-3">
        <a href="{{ route('create') }}" class="btn btn-primary mb-3">新規登録</a>
    </div>
    
    <table class=table>
        <thead>
            <tr>
                <th>商品番号</th>
                <th>商品名</th>
                <th>商品説明</th>
                <th>画像</th>
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
                <td>
                    @if ($product->img_path)
                        <img src="{{ asset('storage/' . $product->img_path) }}" alt="{{ $product->product_name }}" width="120">
                    @endif</td>
                <td>{{ $product->price }}</td>
                <td>
                    <a href="{{ route('mypage.detail',$product->id) }}" class="btn btn-success">詳細</a>

                    <form action="{{ route('destroy',$product->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？');">削除</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">該当する商品はありません</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <h5>＜購入した商品＞</h5>

</div>
@endsection