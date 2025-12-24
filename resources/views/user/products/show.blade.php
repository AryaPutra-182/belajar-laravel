@extends('user.layouts.app')

@section('title', $product->name . ' — TechLife')

@section('content')

<style>
    /* Global Text Visibility */
    body { color: #cbd5e1; }

    .glass-card {
        background: #0f172a;
        border: 1px solid #1e293b;
        border-radius: 24px;
    }

    .product-title {
        color: #ffffff !important;
        font-weight: 800;
        letter-spacing: -1.5px;
        line-height: 1.2;
    }

    .text-gradient {
        background: linear-gradient(to right, #818cf8, #c084fc);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .price-tag {
        font-size: 2rem;
        font-weight: 800;
        color: #818cf8;
    }

    .img-main-container {
        background: #0f172a;
        border: 1px solid #1e293b;
        border-radius: 30px;
        overflow: hidden;
        position: sticky;
        top: 100px;
    }

    .custom-muted {
        color: #94a3b8 !important;
    }

    /* Form Styling */
    .form-control-dark {
        background-color: #020617;
        border: 1px solid #1e293b;
        color: #ffffff;
        border-radius: 12px;
        padding: 10px 15px;
    }
    .form-control-dark:focus {
        background-color: #020617;
        border-color: #6366f1;
        color: #ffffff;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    .btn-checkout {
        background: #6366f1;
        color: white;
        font-weight: 700;
        border-radius: 12px;
        padding: 12px 25px;
        border: none;
        transition: 0.3s;
    }
    .btn-checkout:hover {
        background: #4f46e5;
        box-shadow: 0 0 20px rgba(99, 102, 241, 0.4);
        color: white;
    }

    .review-item {
        border-bottom: 1px solid #1e293b;
        padding: 20px 0;
    }
    .review-item:last-child { border-bottom: none; }

    .rating-star { color: #fbbf24; } /* Amber 400 */
</style>

<div class="container py-4">
    <div class="row g-5">
        
        {{-- BAGIAN KIRI: GAMBAR --}}
        <div class="col-md-5">
            <div class="img-main-container shadow-lg">
                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid w-100" alt="{{ $product->name }}">
                @else
                    <div class="d-flex align-items-center justify-content-center p-5 opacity-25" style="height: 400px;">
                        <i class="bi bi-image display-1 text-white"></i>
                    </div>
                @endif
            </div>
        </div>

        {{-- BAGIAN KANAN: INFO --}}
        <div class="col-md-7">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none custom-muted">Home</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">{{ $product->category->name }}</li>
                </ol>
            </nav>

            <h1 class="product-title display-5 mb-2">{{ $product->name }}</h1>
            
            <div class="d-flex align-items-center mb-4">
                <div class="rating-star me-2">
                    @php $avg = $product->avgRating() ?? 0 @endphp
                    @for($i=1; $i<=5; $i++)
                        <i class="bi bi-star-fill {{ $i <= $avg ? '' : 'text-muted opacity-25' }}"></i>
                    @endfor
                </div>
                <span class="text-white fw-bold me-2">{{ number_format($avg, 1) }}</span>
                <span class="custom-muted small">({{ $product->reviews->count() }} Ulasan)</span>
            </div>

            <div class="price-tag mb-4">
                <span class="text-gradient">Rp {{ number_format($product->price,0,',','.') }}</span>
            </div>

            <div class="glass-card p-4 mb-4">
                <h6 class="text-white fw-bold mb-3 small text-uppercase tracking-wider">Deskripsi Produk</h6>
                <div class="text-muted lh-lg" style="color: #cbd5e1 !important;">
                    {!! nl2br(e($product->description)) !!}
                </div>
            </div>

            {{-- FORM CHECKOUT --}}
            @auth
            <div class="glass-card p-4 mb-5 border-primary border-opacity-25 shadow-sm">
                <form method="POST" action="{{ route('checkout.store',$product->id) }}">
                    @csrf
                    <div class="row align-items-end g-3">
                        <div class="col-md-4">
                            <label class="small fw-bold text-white mb-2">Jumlah</label>
                            <input type="number" name="qty" class="form-control form-control-dark" value="1" min="1">
                        </div>
                        <div class="col-md-8">
                            <button class="btn btn-checkout w-100 py-3">
                                <i class="bi bi-cart-fill me-2"></i> Beli Sekarang
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            @else
            <div class="glass-card p-4 text-center mb-5 border-dashed">
                <p class="custom-muted mb-0 small">
                    Silakan <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">Login</a> untuk melakukan pemesanan.
                </p>
            </div>
            @endauth

            {{-- SECTION ULASAN --}}
            <div class="mt-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold text-white mb-0">Ulasan Pengguna</h4>
                    <span class="custom-muted small">{{ $product->reviews->count() }} Komentar</span>
                </div>

                <div class="glass-card p-4 mb-4">
                    @forelse($product->reviews as $r)
                    <div class="review-item">
                        <div class="d-flex justify-content-between mb-2">
                            <strong class="text-white">{{ $r->user->name }}</strong>
                            <div class="rating-star small">
                                @for($i=1; $i<=5; $i++)
                                    <i class="bi bi-star-fill {{ $i <= $r->rating ? '' : 'text-muted opacity-25' }}"></i>
                                @endfor
                            </div>
                        </div>
                        <p class="small mb-0" style="color: #94a3b8;">{{ $r->comment }}</p>
                    </div>
                    @empty
                    <div class="text-center py-4">
                        <i class="bi bi-chat-dots display-6 custom-muted opacity-25 mb-3 d-block"></i>
                        <p class="custom-muted small">Belum ada ulasan untuk produk ini.</p>
                    </div>
                    @endforelse
                </div>

            {{-- SECTION ULASAN --}}
<div class="mt-5" id="review-section"> {{-- Tambahkan ID di sini agar link dari Pesanan Saya berfungsi --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-white mb-0">Ulasan Pengguna</h4>
        <span class="custom-muted small">{{ $product->reviews->count() }} Komentar</span>
    </div>

    <div class="glass-card p-4 mb-4">
        @forelse($product->reviews as $r)
        <div class="review-item">
            <div class="d-flex justify-content-between mb-2">
                <strong class="text-white">{{ $r->user->name }}</strong>
                <div class="rating-star small">
                    @for($i=1; $i<=5; $i++)
                        <i class="bi bi-star-fill {{ $i <= $r->rating ? '' : 'text-muted opacity-25' }}"></i>
                    @endfor
                </div>
            </div>
            <p class="small mb-0" style="color: #94a3b8;">{{ $r->comment }}</p>
        </div>
        @empty
        <div class="text-center py-4">
            <i class="bi bi-chat-dots display-6 custom-muted opacity-25 mb-3 d-block"></i>
            <p class="custom-muted small">Belum ada ulasan untuk produk ini.</p>
        </div>
        @endforelse
    </div>

    {{-- Bagian Tulis Ulasan --}}
    @auth
       @php
    $isBuyer = \App\Models\OrderItem::where('product_id', $product->id)
        ->whereHas('order', function ($q) {
            $q->where('user_id', auth()->id())
              ->whereIn('status', ['Selesai','Done','done','selesai']);
        })
        ->exists();
@endphp


        @if($isBuyer)
            <div class="glass-card p-4 shadow-sm border-primary border-opacity-10">
                <h6 class="fw-bold text-white mb-4"><i class="bi bi-pencil-square me-2 text-primary"></i>Berikan Penilaian Anda</h6>
                
                @if(session('success'))
                    <div class="alert alert-success bg-success bg-opacity-10 border-success border-opacity-25 text-success small mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('reviews.store', $product->id) }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="text-white small fw-bold mb-2">Rating</label>
                            <select name="rating" class="form-control form-control-dark" required>
                                <option value="">Pilih Rating</option>
                                <option value="5">5 Bintang ⭐⭐⭐⭐⭐</option>
                                <option value="4">4 Bintang ⭐⭐⭐⭐</option>
                                <option value="3">3 Bintang ⭐⭐⭐</option>
                                <option value="2">2 Bintang ⭐⭐</option>
                                <option value="1">1 Bintang ⭐</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="text-white small fw-bold mb-2">Komentar</label>
                            <textarea name="comment" class="form-control form-control-dark" rows="3" placeholder="Bagikan pengalaman Anda menggunakan produk ini..." required></textarea>
                        </div>
                    </div>
                    <button class="btn btn-primary mt-3 px-4 py-2 rounded-3 fw-bold shadow-sm" style="background: #6366f1; border: none;">
                        Kirim Ulasan Sekarang
                    </button>
                </form>
            </div>
        @else
            {{-- Pesan Jika Belum Beli atau Status Belum Selesai --}}
            <div class="glass-card p-4 text-center border-dashed border-secondary opacity-75">
                <i class="bi bi-cart-x display-6 custom-muted opacity-25 mb-3 d-block"></i>
                <p class="custom-muted small mb-1">Fitur ulasan hanya tersedia untuk pembeli terverifikasi.</p>
                <p class="text-white-50 extra-small" style="font-size: 0.7rem;">Pastikan pesanan Anda sudah berstatus <span class="text-success">Selesai</span> di halaman Pesanan Saya.</p>
            </div>
        @endif
    @else
        <div class="glass-card p-4 text-center">
            <p class="custom-muted mb-0 small">Silakan <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">Login</a> untuk memberikan ulasan.</p>
        </div>
    @endauth
</div>
            </div>
        </div>
    </div>
</div>

@endsection