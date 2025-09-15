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
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 bg-primary-subtle">
        <h3>Cytech EC</h3>
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
</body>
</html>