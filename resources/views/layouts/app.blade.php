<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bookstore</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        nav a { margin-right: 10px; }
        table { border-collapse: collapse; width: 100%; margin-top: 1rem; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f0f0f0; }
        form { margin-bottom: 1rem; }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('books.index') }}">Books</a> |
        <a href="{{ route('authors.top') }}">Top Authors</a> |
        <a href="{{ route('ratings.create') }}">Input Rating</a>
    </nav>
    <hr>
    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif
    @yield('content')
</body>
</html>
