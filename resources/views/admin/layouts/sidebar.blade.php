<aside class="main-sidebar sidebar-dark-primary elevation-4">
    {{-- Brand --}}
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    {{-- Sidebar --}}
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false">

                {{-- Dashboard --}}
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                       class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- Kategori --}}
                <li class="nav-item">
                    <a href="{{ route('admin.categories.index') }}"
                       class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <p>Kategori</p>
                    </a>
                </li>

                {{-- Produk --}}
                <li class="nav-item">
                    <a href="{{ route('admin.products.index') }}"
                       class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                        <p>Produk</p>
                    </a>
                </li>

                {{-- Ulasan --}}
                <li class="nav-item">
                    <a href="{{ route('admin.reviews.index') }}"
                       class="nav-link {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">
                        <p>Ulasan</p>
                    </a>
                </li>

                {{-- Forum --}}
                <li class="nav-item">
                    <a href="{{ route('admin.forums.index') }}"
                       class="nav-link {{ request()->routeIs('admin.forums.*') ? 'active' : '' }}">
                        <p>Forum</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
