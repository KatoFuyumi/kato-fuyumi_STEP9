@extends('app')

@section('title','商品一覧')

@section('content')
<div class="container">
    <h1>商品詳細</h1>

    <div class="container">
        <h2>{{ $product->name }}</h2>
        <p>{{ $product->content}}</p>
        @if($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid">
        @endif
        <p>¥{{ $product->price }}</p>
    </div>

    <a href="{{ route('edit',$product->id) }}" class="btn btn-primary">更新する</a>
    <a href="{{ route('index') }}" class="btn btn-secondary">一覧に戻る</a>

</div>
@endsection