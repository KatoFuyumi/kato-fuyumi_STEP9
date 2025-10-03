@extends('app')

@section('title','出品商品詳細')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
<script src="{{ asset('js/like.js') }}"></script>

<div class="container">
    <div class="pb-3">
        <h1>出品商品詳細</h1>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    <div class="container">
        <p>商品名：{{ $product->product_name }}</p>
        <p>説明：{{ $product->description}}</p>

        <div class="d-flex align-items-center gap-5">
            @if($product->img_path)
            <p>画像：</p>
            <img src="{{ asset('storage/' . $product->img_path) }}" alt="{{ $product->product_name }}" class="img-fluid">
            @endif
        </div>
        
        <p>金額：¥{{ $product->price }}</p>
    </div>

    <a href="{{ route('edit',$product->id) }}" class="btn btn-primary">編集</a>

    <form action="{{ route('destroy',$product->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？');">削除</button>
    </form>
    <a href="{{ route('mypage') }}" class="btn btn-secondary">戻る</a>
    

</div>
@endsection