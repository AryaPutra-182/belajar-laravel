<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    {{-- Toggle Sidebar --}}
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                ☰
            </a>
        </li>
    </ul>

    {{-- Right Navbar --}}
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-sm btn-danger">
                    Logout
                </button>
            </form>
        </li>
    </ul>
</nav>
