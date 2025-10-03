@extends('app')

@section('title','商品購入')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
<script src="{{ asset('js/like.js') }}"></script>

<div class="container">

    <div class="pb-3">
        <h1>商品購入</h1>
    </div>
    
        <div class="container">
            <p>商品名：{{ $product->product_name }}</p>
            <p>説明：{{ $product->description}}</p>

            <div class="d-flex flex-wrap align-items-center gap-5">
                @if($product->img_path)
                <img src="{{ asset('storage/' . $product->img_path) }}" alt="{{ $product->product_name }}" class="img-fluid">
                @endif
            </div>
        
            <p>金額：¥{{ $product->price }}</p>
            <p>残り：{{ $product->stock }}</p>
            <p>会社：{{ $product->company->company_name }}</p>
        </div>

        <form action="{{ route('purchase') }}" method="POST">
            @csrf
            <p>数量:</p><input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="number" id="quantity" name="quantity" class="form-control" value="1" min="1" style="width: 120px;">

            <div class="d-flex mt-3 gap-1">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#purchaseModal">購入する</button>
                <a href="{{ route('detail',$product->id) }}" class="btn btn-secondary">戻る</a>
            </div>
        </form>
</div>

<!-- モーダル本体 -->
<div class="modal fade" id="purchaseModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">購入確認</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p>商品名：{{ $product->product_name }}</p>
        <p>金額：¥{{ $product->price }}</p>
        <p>数量：<span id="modalQuantity">1</span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>

        <!-- 購入フォーム -->
        <form action="{{ route('purchase') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="quantity" id="hiddenQuantity" value="1">
            <button type="submit" class="btn btn-primary">購入確定</button>
        </form>

      </div>
    </div>
  </div>
</div>
<script src="{{ asset('js/purchase.js') }}"></script>

@endsection