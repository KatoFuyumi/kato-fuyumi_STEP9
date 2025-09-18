@extends('app')

@section('title','商品一覧')

@section('content')
<div class="container">
    <h1>商品一覧</h1>

    <div class="d-flex mb-3">
        <a href="{{ route('create') }}" class="btn btn-success mb-3">商品新規登録</a>
        <a href="{{ route('index') }}" class="ms-auto">他の人の商品</a>
    </div>

    <form action="{{ route('search') }}" method="GET" class="my-3">
        <div class="row align-items-center">
        <div class="col-4">
            <input type="text" name="product_name" class="form-control" placeholder="商品名を入力" value="{{ request('product_name') }}">
        </div>

        <div class="col-4 d-flex">
            <input type="text" name="price_min" class="form-control" placeholder="最低価格" value="{{ request('price_min') }}">
            <span>~</span>
            <input type="text" name="price_max" class="form-control" placeholder="最高価格" value="{{ request('price_max') }}">
        </div>

        <div class="col-2">
            <button type="submit" class="btn btn-primary">検索</button>
        </div>
        </div>
    </form>

    <table>
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
                    <a href="{{ route('detail',$product->id) }}" class="btn btn-success">詳細</a>

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

</div>
@endsection