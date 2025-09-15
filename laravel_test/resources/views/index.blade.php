@extends('app')

@section('title','商品一覧')

@section('content')
<div class="container">
    <h1>商品一覧</h1>

    <a href="{{ route('create') }}" class="btn btn-success mb-3">商品新規登録</a>

    <table border="1">
        <thead>
            <tr>
                <th>商品番号</th>
                <th>商品名</th>
                <th>商品説明</th>
                <th>画像</th>
                <th>料金(¥)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->content }}</td>
                <td>
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="120">
                    @endif</td>
                <td>{{ $product->price }}</td>
                <td>
                    <a href="{{ route('detail',$product->id) }}" class="btn btn-primary">詳細</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection