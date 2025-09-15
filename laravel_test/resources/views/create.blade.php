@extends('app')

@section('title','商品新規登録')

@section('content')
<div class="container">
    <h1>商品新規登録</h1>

    <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="product_name">商品名:</label>
            <input type="text" id="product_name" name="product_name" id="product_name" class="form-control">
        </div>

        <div class="form-group">
            <label for="description">商品説明:</label>
            <textarea id="description" name="description" id="description" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="img_path">画像:</label>
            <input type="file" id="img_path" name="img_path" id="img_path" class="form-control">
        </div>

        <div class="form-group">
            <label for="price">料金(¥):</label>
            <input type="text" id="price" name="price" id="price" class="form-control">
        </div>

        <div class="form-group">
            <label for="stock">在庫数:</label>
            <input type="number" id="stock" name="stock" id="stock" class="form-control" value="{{ old('stock', 0) }}">
        </div>

        <button type="submit" class="btn btn-primary">登録</button>

    </form>

</div>
@endsection