@extends('app')

@section('title','商品詳細')

@section('content')
<div class="container">
    <h1>商品詳細</h1>

    <div class="container">
        <h2>{{ $product->product_name }}</h2>
        <p>{{ $product->description}}</p>
        @if($product->img_path)
        <img src="{{ asset('storage/' . $product->img_path) }}" alt="{{ $product->product_name }}" class="img-fluid">
        @endif
        <p>¥{{ $product->price }}</p>
    </div>

    <a href="{{ route('edit',$product->id) }}" class="btn btn-primary">更新する</a>
    <a href="{{ route('index') }}" class="btn btn-secondary">一覧に戻る</a>

</div>
@endsection