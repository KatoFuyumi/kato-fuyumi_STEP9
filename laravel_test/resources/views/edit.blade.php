@extends('app')

@section('title','商品一覧')

@section('content')
<div class="container">
    <h1>商品を編集</h1>

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
            <label for='name'>商品名</label>
            <input type="text" name="name" class="form-control" value="{{ old('name',$product->name) }}">
        </div>

        <div class="form-group">
            <label for='content'>商品説明</label>
            <textarea name="content" class="form-control" rows="5">{{ old('content',$product->content) }}</textarea>
        </div>

        @if($product->image)
        <div class="form-group">
            <label>現在の画像</label>
            <div>
                <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image" style="max-width: 200px; height: auto;">
            </div>
        </div>
        @endif

        <div class="form-group">
            <label for="image">画像をアップロード</label>
            <input type="file" name="image" class="form-control-file">
        </div>

        <div class="form-group">
            <label for='price'>金額</label>
            <input type="text" name="price" class="form-control" value="{{ old('price',$product->price) }}">
        </div>

        <button type="submit" class="btn btn-primary">更新する</button>
        <a href="{{ route('detail',$product->id) }}" class="btn btn-secondary">キャンセル</a>
    </form>
</div>
@endsection