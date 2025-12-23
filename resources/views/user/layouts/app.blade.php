<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title','TechLife')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">TechLife</a>
        <a href="{{ route('orders.mine') }}" class="btn btn-sm btn-warning">Pesanan</a>
        <div class="ms-auto">
            @auth
                <span class="text-white me-2">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button class="btn btn-sm btn-danger">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light">Login</a>
            @endauth
        </div>
    </div>
</nav>

<div class="container">
    @yield('content')
</div>

</body>
</html>
