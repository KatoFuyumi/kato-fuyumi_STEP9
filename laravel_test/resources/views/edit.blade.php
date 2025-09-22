@extends('app')

@section('title','出品商品編集')

@section('content')
<div class="container">
    <h1>出品商品編集</h1>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- 編集フォーム --}}
    <form action="{{ route('update',$product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for='product_name'>商品名</label>
            <input type="text" id="product_name" name="product_name" class="form-control" value="{{ old('product_name',$product->product_name) }}">
        </div>

        <div class="form-group">
            <label for='description'>商品説明</label>
            <textarea id="description" name="description" class="form-control" rows="5">{{ old('description',$product->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for='price'>金額</label>
            <input type="text" id="price" name="price" class="form-control" value="{{ old('price',$product->price) }}">
        </div>

        <div class="form-group">
            <label for="stock">在庫数:</label>
            <input type="number" id="stock" name="stock" id="stock" class="form-control" value="{{ old('stock',$product->stock) }}">
        </div>

        <div class="d-flex flex-wrap align-items-center gap-5">
            @if($product->img_path)
            <div class="form-group d-flex flex-wrap align-items-center">
                <label>商品画像</label>
                <div>
                    <img src="{{ asset('storage/' . $product->img_path) }}" alt="Current Image" style="max-width: 200px; height: auto;">
                </div>
            </div>
            @endif

            <div class="form-group">
                <label for="img_path"></label>
                <input type="file" id="img_path" name="img_path" class="form-control-file">
            </div>
        </div>

        <a href="{{ route('mypage.detail',$product->id) }}" class="btn btn-secondary">戻る</a>
        <button type="submit" class="btn btn-primary">更新する</button>
        
    </form>
</div>
@endsection