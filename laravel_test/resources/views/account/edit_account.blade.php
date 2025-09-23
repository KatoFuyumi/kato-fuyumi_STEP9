@extends('app')

@section('title','アカウント情報編集')

@section('content')
<div class="container">
    <h1>アカウント情報編集</h1>
    
     @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('account.update') }}" method="POST" class="container mt-4">

        @csrf
        <div>
            <label for="name">ユーザ名</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name',$user->name) }}">
        </div>

        <div class="mb-3">
            <label for="email">Eメール</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email',$user->email) }}">
        </div>

        <div>
            <label for="name_kanji">名前</label>
            <input type="text" id="name_kanji" name="name_kanji" class="form-control" value="{{ old('name_kanji',$user->name_kanji) }}">
        </div>

        <div>
            <label for="name_kana">カナ</label>
            <input type="text" id="name_kana" name="name_kana" class="form-control" value="{{ old('name_kana',$user->name_kana) }}">
        </div>

        <a href="{{ route('mypage') }}" class="btn btn-secondary">戻る</a>
        <button type="submit" class="btn btn-primary">更新する</button>
    </form>

</div>
@endsection