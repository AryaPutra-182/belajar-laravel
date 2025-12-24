@extends('user.layouts.app')

@section('title', 'Dashboard User — TechLife')

@section('content')

<style>
    .glass-card {
        background: #0f172a;
        border: 1px solid #1e293b;
        border-radius: 20px;
        transition: all 0.3s ease;
    }
    .glass-card:hover {
        border-color: #6366f1;
        box-shadow: 0 0 20px rgba(99, 102, 241, 0.1);
    }
    .text-gradient {
        background: linear-gradient(to right, #818cf8, #c084fc);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .stat-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(99, 102, 241, 0.1);
        border-radius: 12px;
        color: #818cf8;
        margin-bottom: 15px;
    }
    .table-dark-custom {
        color: #cbd5e1;
    }
    .table-dark-custom thead th {
        border-bottom: 2px solid #1e293b;
        color: #ffffff;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 1px;
    }
    .table-dark-custom td {
        border-bottom: 1px solid #1e293b;
        padding: 1rem 0.75rem;
    }
    .action-link {
        color: #818cf8;
        text-decoration: none;
        font-weight: 600;
        transition: 0.3s;
    }
    .action-link:hover {
        color: #ffffff;
    }
</style>

{{-- HEADER --}}
<div class="mb-5 mt-4">
    <h2 class="fw-bold text-white mb-1">Halo, <span class="text-gradient">{{ auth()->user()->name }}</span> 👋</h2>
    <p style="color: #94a3b8;">Selamat datang kembali! Berikut ringkasan aktivitas akunmu.</p>
</div>

{{-- SUMMARY STATS --}}
<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="glass-card p-4">
            <div class="stat-icon"><i class="bi bi-bag-check-fill fs-4"></i></div>
            <h3 class="fw-bold text-white">{{ $orderCount }}</h3>
            <p class="mb-0 small text-uppercase tracking-wider">Total Pesanan</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="glass-card p-4">
            <div class="stat-icon"><i class="bi bi-star-fill fs-4 text-warning"></i></div>
            <h3 class="fw-bold text-white">{{ $reviewCount }}</h3>
            <p class="mb-0 small text-uppercase tracking-wider">Ulasan Dibuat</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="glass-card p-4">
            <div class="stat-icon"><i class="bi bi-chat-square-text-fill fs-4 text-info"></i></div>
            <h3 class="fw-bold text-white">{{ $threadCount }}</h3>
            <p class="mb-0 small text-uppercase tracking-wider">Thread Forum</p>
        </div>
    </div>
</div>

{{-- QUICK ACTIONS --}}
<div class="mb-5">
    <h5 class="fw-bold text-white mb-3"><i class="bi bi-lightning-charge me-2 text-primary"></i>Akses Cepat</h5>
    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('home') }}" class="btn btn-primary px-4 rounded-3 shadow-sm" style="background: #6366f1; border:none;">
            <i class="bi bi-cart3 me-2"></i>Belanja Produk
        </a>
        <a href="{{ route('orders.mine') }}" class="btn btn-outline-light px-4 rounded-3 border-secondary border-opacity-25">
            <i class="bi bi-clock-history me-2"></i>Riwayat Pesanan
        </a>
        <a href="{{ route('forum.index') }}" class="btn btn-dark px-4 rounded-3 border border-secondary border-opacity-25">
            <i class="bi bi-people me-2"></i>Kunjungi Forum
        </a>
    </div>
</div>

<div class="row g-4">
    {{-- PESANAN TERBARU --}}
    <div class="col-lg-8">
        <div class="glass-card p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold text-white mb-0">Pesanan Terbaru</h5>
                <a href="{{ route('orders.mine') }}" class="small action-link">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table table-dark-custom mb-0">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestOrders as $o)
                        <tr>
                            <td class="text-white fw-semibold">{{ $o->product->name }}</td>
                            <td>Rp {{ number_format($o->total,0,',','.') }}</td>
                            <td>
                                <span class="badge rounded-pill px-3 py-2" style="background: rgba(255,255,255,0.05); color: #cbd5e1; border: 1px solid rgba(255,255,255,0.1);">
                                    {{ $o->status }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-5 text-muted">Belum ada pesanan terbaru</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- SIDEBAR AKTIVITAS --}}
    <div class="col-lg-4">
        {{-- ULASAN --}}
        <div class="glass-card p-4 mb-4">
            <h5 class="fw-bold text-white mb-4">Ulasan Terakhir</h5>
            @forelse($latestReviews as $r)
                <div class="mb-3 pb-3 border-bottom border-secondary border-opacity-10">
                    <p class="mb-1 text-white fw-semibold small text-truncate">{{ $r->product->name }}</p>
                    <div class="text-warning small">
                        @for($i=1; $i<=5; $i++)
                            <i class="bi bi-star-fill {{ $i <= $r->rating ? '' : 'text-muted opacity-25' }}"></i>
                        @endfor
                        <span class="ms-1 text-muted">({{ $r->rating }})</span>
                    </div>
                </div>
            @empty
                <p class="text-muted small py-3 mb-0">Belum ada ulasan yang kamu berikan.</p>
            @endforelse
        </div>

        {{-- FORUM --}}
        <div class="glass-card p-4">
            <h5 class="fw-bold text-white mb-4">Aktivitas Forum</h5>
            @forelse($latestComments as $c)
                <div class="d-flex gap-3 mb-3">
                    <div class="text-primary"><i class="bi bi-chat-text"></i></div>
                    <div>
                        <p class="mb-1 small text-muted">Komentar di:</p>
                        <a href="{{ route('forum.show',$c->thread->id) }}" class="small text-white text-decoration-none fw-semibold lh-sm d-block">
                            {{ \Illuminate\Support\Str::limit($c->thread->title, 50) }}
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-muted small py-3 mb-0">Tidak ada aktivitas forum terbaru.</p>
            @endforelse
        </div>
    </div>
</div>

@endsection