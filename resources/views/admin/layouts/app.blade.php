<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>

    {{-- AdminLTE CSS --}}
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    {{-- Navbar --}}
    @include('admin.layouts.navbar')

    {{-- Sidebar --}}
    @include('admin.layouts.sidebar')

    {{-- Content --}}
    <div class="content-wrapper">
        <section class="content p-4">
            @yield('content')
        </section>
    </div>

</div>

{{-- AdminLTE JS --}}
<script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>
</body>
</html>
