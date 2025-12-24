<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','TechLife — Premium Tech & Lifestyle')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --bg-deep: #020617;
            --nav-bg: rgba(15, 23, 42, 0.8); /* Transparan */
            --border-color: #1e293b;
            --accent-color: #6366f1;
            --text-main: #f1f5f9;
        }

        body {
            background-color: var(--bg-deep);
            color: #94a3b8;
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
        }

        /* Navbar Modern Glassmorphism */
        .navbar-custom {
            background: var(--nav-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border-color);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            letter-spacing: -1px;
            color: var(--text-main) !important;
        }

        .navbar-brand span {
            color: var(--accent-color);
        }

        .nav-link {
            color: #94a3b8 !important;
            font-weight: 600;
            transition: 0.3s;
        }

        .nav-link:hover {
            color: var(--accent-color) !important;
        }

        /* Button Styling */
        .btn-order {
            background: rgba(99, 102, 241, 0.1);
            color: var(--accent-color);
            border: 1px solid rgba(99, 102, 241, 0.3);
            font-weight: 600;
            border-radius: 10px;
            transition: 0.3s;
        }

        .btn-order:hover {
            background: var(--accent-color);
            color: white;
        }

        .btn-logout {
            background: transparent;
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.2);
            border-radius: 10px;
        }

        .btn-logout:hover {
            background: #ef4444;
            color: white;
        }

        footer {
            border-top: 1px solid var(--border-color);
            padding: 40px 0;
            margin-top: 60px;
            color: #475569;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            Tech<span>Life</span>
        </a>
        
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-lg-4 me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('forum.index') }}">Forum</a>
                </li>
            </ul>

            <div class="d-flex align-items-center gap-3">
                @auth
                    <a href="{{ route('orders.mine') }}" class="btn btn-sm btn-order px-3 py-2">
                        <i class="bi bi-bag-check me-1"></i> Pesanan
                    </a>
                    <div class="vr mx-2 d-none d-lg-block text-secondary"></div>
                    <span class="text-white small fw-bold d-none d-md-block">
                        <i class="bi bi-person-circle me-1"></i> {{ auth()->user()->name }}
                    </span>
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button class="btn btn-sm btn-logout px-3 py-2">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light rounded-3 px-4 py-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-sm btn-indigo rounded-3 px-4 py-2" style="background: #6366f1; color:white; border:none;">Daftar</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<main class="container">
    @yield('content')
</main>

<footer class="text-center">
    <div class="container">
        <p class="mb-1 fw-bold text-white">TechLife Store — Your Digital Companion</p>
        <p class="small mb-0">&copy; {{ date('Y') }} TechLife Team. All rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>