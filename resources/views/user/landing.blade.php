@extends('user.layouts.app')

@section('title','TechLife — Teknologi & Lifestyle')

@section('content')

{{-- HERO SECTION --}}
<div class="p-5 mb-4 bg-dark text-white rounded">
    <div class="container py-5">
        <h1 class="display-5 fw-bold">TechLife Store</h1>
        <p class="col-md-8 fs-5">
            Temukan produk teknologi dan lifestyle terbaik,
            lengkap dengan ulasan pengguna asli.
        </p>

        <div class="mt-4">
            <a href="{{ route('home') }}" class="btn btn-primary btn-lg me-2">
                Jelajahi Produk
            </a>

            @auth
                <a href="{{ route('orders.mine') }}" class="btn btn-outline-light btn-lg">
                    Pesanan Saya
                </a>
            @endauth
        </div>
    </div>
</div>

{{-- FITUR --}}
<div class="row text-center mb-5">
    <div class="col-md-4">
        <div class="p-3 border rounded h-100">
            <h5>🔒 Aman</h5>
            <p class="mb-0">Transaksi tercatat dan transparan</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="p-3 border rounded h-100">
            <h5>⭐ Ulasan Asli</h5>
            <p class="mb-0">Rating langsung dari pengguna</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="p-3 border rounded h-100">
            <h5>⚡ Cepat</h5>
            <p class="mb-0">Checkout sederhana tanpa ribet</p>
        </div>
    </div>
</div>

{{-- PRODUK TERBARU --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Produk Terbaru</h3>
    <a href="{{ route('home') }}" class="btn btn-sm btn-outline-secondary">
        Lihat Semua
    </a>
</div>

<div class="row">
    @foreach($products as $p)
    <div class="col-md-3 mb-4">
        <div class="card h-100 shadow-sm">

            @if($p->image)
                <img src="{{ asset('storage/'.$p->image) }}"
                     class="card-img-top"
                     style="height:180px; object-fit:cover">
            @endif

            <div class="card-body d-flex flex-column">
                <h6 class="mb-1">{{ $p->name }}</h6>
                <p class="fw-bold text-success mb-2">
                    Rp {{ number_format($p->price,0,',','.') }}
                </p>

                <div class="mt-auto">
                    <a href="{{ route('products.show',$p->id) }}"
                       class="btn btn-sm btn-primary w-100">
                        Detail Produk
                    </a>
                </div>
            </div>

        </div>
    </div>
    @endforeach
</div>

{{-- CTA BAWAH --}}
<div class="text-center mt-5 p-4 bg-light rounded">
    <h4 class="mb-3">Siap Berbelanja?</h4>
    <p class="text-muted">
        Temukan produk favoritmu dan cek riwayat pesanan dengan mudah.
    </p>

    <a href="{{ route('home') }}" class="btn btn-success btn-lg me-2">
        Mulai Belanja
    </a>

    @auth
        <a href="{{ route('orders.mine') }}" class="btn btn-outline-secondary btn-lg">
            Pesanan Saya
        </a>
    @endauth
</div>

@endsection
