<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品詳細</title>
</head>

<body>
    <h1>商品詳細</h1>

    <div class="container">
        <h2>{{ $product->name }}</h2>
        <p>{{ $product->content}}</p>
        @if($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid">
        @endif
        <p>¥{{ $product->price }}</p>
    </div>
</body>
</html>
