@extends('app')

@section('title','商品詳細')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
<script src="{{ asset('js/like.js') }}"></script>

<div class="container">
    <div class="pb-3">
        <h1>商品詳細</h1>
    </div>

    <div class="container">
        <p>商品名：{{ $product->product_name }}</p>
        <p>説明：{{ $product->description}}</p>

        <div class="d-flex align-items-center gap-5">
            @if($product->img_path)
            <p>画像：</p><img src="{{ asset('storage/' . $product->img_path) }}" alt="{{ $product->product_name }}" class="img-fluid">
            @endif
        </div>
        
        <p>金額：¥{{ $product->price }}</p>
        <p>会社：{{ $company->company_name }}</p>
    </div>

    <div class="mb-3">
        <button id="like-btn" class="border-0 bg-transparent"
            data-product-id="{{ $product->id }}">
            @if($product->likedBy(Auth::user())) 
            <i class="fa-solid fa-heart" style="color: red;"></i>
            @else
            <i class="fa-regular fa-heart" style="color: black;"></i> <!-- 未いいね -->
            @endif
        </button>
    </div>

    <a href="{{ route('products.purchase', ['product_id' => $product->id]) }}" class="btn btn-primary">カートに追加する</a>
    <a href="{{ route('index') }}" class="btn btn-secondary">戻る</a>

</div>
@endsection