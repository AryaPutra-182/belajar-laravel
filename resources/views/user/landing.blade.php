@extends('user.layouts.app')

@section('title','TechLife — Premium Dark Edition')

@section('content')

<style>
    :root {
        --bg-midnight: #020617;     /* Latar paling gelap */
        --card-bg: #0f172a;         /* Latar kartu */
        --border-color: #1e293b;    /* Warna garis tepi */
        --primary-accent: #6366f1;  /* Warna Indigo */
        --text-main: #ffffff;      /* Putih murni untuk judul */
        --text-secondary: #cbd5e1;  /* Abu terang untuk paragraf */
    }

    body { 
        background-color: var(--bg-midnight); 
        color: var(--text-secondary);
        font-family: 'Inter', sans-serif;
    }

    /* Hero Styling - Centered & Bold */
    .hero-wrapper {
        padding: 100px 0;
        text-align: center;
        background: radial-gradient(circle at center, rgba(99, 102, 241, 0.1) 0%, transparent 70%);
        border-bottom: 1px solid var(--border-color);
        margin-bottom: 60px;
    }

    .hero-title {
        font-size: 4rem;
        font-weight: 800;
        color: var(--text-main);
        letter-spacing: -2px;
        line-height: 1.1;
    }

    .text-gradient {
        background: linear-gradient(to right, #818cf8, #c084fc);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Card Styling */
    .premium-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 20px;
        transition: all 0.3s ease;
        height: 100%;
    }
    .premium-card:hover {
        border-color: var(--primary-accent);
        transform: translateY(-5px);
    }

    .card-img-wrapper {
        height: 220px;
        background: #1e293b;
        border-radius: 20px 20px 0 0;
        overflow: hidden;
    }
    .card-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Button */
    .btn-main {
        background: var(--primary-accent);
        color: white;
        border-radius: 12px;
        padding: 12px 30px;
        font-weight: 600;
        border: none;
        transition: 0.3s;
    }
    .btn-main:hover {
        background: #4f46e5;
        box-shadow: 0 0 20px rgba(99, 102, 241, 0.4);
        color: white;
    }

    .btn-outline {
        border: 1px solid var(--border-color);
        color: var(--text-main);
        border-radius: 12px;
        padding: 12px 30px;
    }
    .btn-outline:hover {
        background: white;
        color: black;
    }

    /* Visibility Fix for Headings */
    h1, h2, h3, h4, h5, h6 {
        color: var(--text-main) !important;
    }
</style>

{{-- HERO SECTION --}}
<div class="hero-wrapper">
    <div class="container">
        <span class="badge rounded-pill mb-3 px-3 py-2" style="background: rgba(99,102,241,0.2); color: #818cf8; border: 1px solid rgba(99,102,241,0.3);">
            🚀 Evolusi Teknologi & Lifestyle
        </span>
        <h1 class="hero-title mb-3">
            Upgrade Your Life <br> With <span class="text-gradient">TechLife.</span>
        </h1>
        <p class="mx-auto mb-5 fs-5" style="max-width: 700px; color: var(--text-secondary);">
            Katalog produk pilihan, diskusi komunitas yang mendalam, dan wawasan teknologi terbaru. Semuanya dalam satu platform yang elegan.
        </p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('home') }}" class="btn btn-main">Jelajahi Katalog</a>
            @auth
                <a href="{{ route('forum.index') }}" class="btn btn-outline">Forum Diskusi</a>
            @endauth
        </div>
    </div>
</div>

<div class="container">
    {{-- STATS BAR --}}
    <div class="row g-4 mb-5">
        @php
            $features = [
                ['icon' => 'bi-shield-lock', 'title' => 'Aman', 'desc' => 'Transaksi terenkripsi'],
                ['icon' => 'bi-cpu', 'title' => 'Modern', 'desc' => 'Gadget rilisan terbaru'],
                ['icon' => 'bi-chat-dots', 'title' => 'Komunitas', 'desc' => 'Diskusi aktif 24/7']
            ];
        @endphp
        @foreach($features as $f)
        <div class="col-md-4 text-center">
            <div class="p-4 premium-card">
                <i class="bi {{ $f['icon'] }} fs-1 text-gradient mb-3 d-block"></i>
                <h5 class="fw-bold">{{ $f['title'] }}</h5>
                <p class="small mb-0" style="color: var(--text-secondary);">{{ $f['desc'] }}</p>
            </div>
        </div>
        @endforeach
    </div>

    {{-- PRODUK TERBARU --}}
    <div class="d-flex justify-content-between align-items-end mb-4 pt-4">
        <div>
            <h2 class="fw-bold mb-0">Produk Pilihan</h2>
            <p style="color: var(--text-secondary);">Rekomendasi terbaik untuk Anda.</p>
        </div>
        <a href="{{ route('home') }}" class="text-decoration-none fw-bold" style="color: var(--primary-accent);">
            Lihat Semua <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    <div class="row g-4 mb-5">
        @foreach($products as $p)
        <div class="col-6 col-md-3">
            <div class="premium-card">
                <div class="card-img-wrapper">
                    @if($p->image)
                        <img src="{{ asset('storage/'.$p->image) }}" alt="{{ $p->name }}">
                    @else
                        <div class="h-100 d-flex align-items-center justify-content-center">
                            <i class="bi bi-box text-muted fs-1"></i>
                        </div>
                    @endif
                </div>
                <div class="p-3">
                    <h6 class="fw-bold text-truncate">{{ $p->name }}</h6>
                    <h5 class="fw-bold text-gradient mb-3">Rp {{ number_format($p->price,0,',','.') }}</h5>
                    <a href="{{ route('products.show',$p->id) }}" class="btn btn-outline w-100 py-2 btn-sm">Detail Produk</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- INSIGHT SECTION --}}
    <div class="py-5">
        <h2 class="fw-bold mb-4">Artikel Terbaru</h2>
        <div class="row g-4">
            @forelse($articles->take(3) as $a)
            <div class="col-md-4">
                <div class="premium-card p-3">
                    <div class="card-img-wrapper rounded-3 mb-3" style="height: 150px;">
                        @if($a->thumbnail)
                            <img src="{{ asset('storage/'.$a->thumbnail) }}" alt="{{ $a->title }}">
                        @else
                            <div class="h-100 bg-secondary opacity-25"></div>
                        @endif
                    </div>
                    <h6 class="fw-bold mb-2 lh-base" style="height: 45px; overflow: hidden;">{{ $a->title }}</h6>
                    <a href="{{ route('articles.show',$a->id) }}" class="text-decoration-none small fw-bold" style="color: var(--primary-accent);">
                        Baca Insight <i class="bi bi-chevron-right ms-1"></i>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5 border rounded-4 border-secondary border-opacity-25">
                <p class="text-muted mb-0">Belum ada artikel yang dipublikasikan.</p>
            </div>
            @endforelse
        </div>
    </div>

    {{-- COMMUNITY CALLOUT --}}
    <div class="p-5 mt-5 rounded-5 text-center" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); margin-bottom: 80px;">
        <h2 class="fw-bold text-white mb-3">Tanyakan Apapun di Forum</h2>
        <p class="text-white-50 mb-4 mx-auto" style="max-width: 500px;">
            Dapatkan solusi teknis atau sekadar berbagi pengalaman seputar gadget favorit Anda.
        </p>
        <a href="{{ route('forum.index') }}" class="btn btn-light btn-lg px-5 fw-bold rounded-pill">Gabung Komunitas</a>
    </div>
</div>

@endsection