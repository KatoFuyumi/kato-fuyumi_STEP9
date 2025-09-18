<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Cytech EC')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous">
        
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 bg-primary-subtle">
        <a href="{{ route('index') }}" class="text-decoration-none link-body-emphasis ms-3">
            <h3>Cytech EC</h3>
        </a>
        
        <div class="d-flex align-items-center ms-auto gap-3 me-4">
        
            <a href="{{ route('index') }}" class="text-decoration-none">Home</a>
            <a href="{{ route('index') }}" class="text-decoration-none">マイページ</a>

            <div>ログインユーザー: {{ auth()->user()->name }}</div>

            <div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
                </form>
                <a class="btn btn-danger" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    ログアウト
                </a>
            </div>
        </div>
    </header>

    <div class="container">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="col-8">
            @yield('content')
        </div>
    </div>

    <footer class="d-flex flex-wrap justify-content-center py-3 mt-5 bg-primary-subtle">
        <p>&copy; 2025 All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>