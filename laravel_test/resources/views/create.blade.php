@extends('app')

@section('title','商品一覧')

@section('content')
<div class="container">
    <h1>商品新規登録</h1>

    <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">商品名:</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>

        <div class="form-group">
            <label for="content">商品説明:</label>
            <textarea name="content" id="content" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="image">画像:</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <div class="form-group">
            <label for="price">料金(¥):</label>
            <input type="text" name="price" id="price" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">登録</button>

    </form>

</div>
@endsection