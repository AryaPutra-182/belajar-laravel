@extends('user.layouts.app')

@section('title', 'Katalog Produk — TechLife Store')

@section('content')

<style>
    /* Global Text Visibility */
    body {
        color: #cbd5e1; /* Slate 300 */
    }

    .glass-card {
        background: #0f172a;
        border: 1px solid #1e293b;
        border-radius: 20px;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
    }
    .glass-card:hover {
        transform: translateY(-10px);
        border-color: #6366f1;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
    }

    .text-gradient {
        background: linear-gradient(to right, #818cf8, #c084fc);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Image Wrapper with Aspect Ratio 1:1 */
    .product-img-wrapper {
        width: 100%;
        aspect-ratio: 1/1;
        background: #1e293b;
        position: relative;
        overflow: hidden;
    }
    .product-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .glass-card:hover .product-img-wrapper img {
        transform: scale(1.1);
    }

    /* Memperbaiki teks redup agar terbaca */
    .custom-muted {
        color: #94a3b8 !important; /* Slate 400 */
    }

    .category-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background: rgba(15, 23, 42, 0.8);
        backdrop-filter: blur(8px);
        color: #818cf8;
        border: 1px solid rgba(129, 140, 248, 0.3);
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        padding: 5px 12px;
        border-radius: 8px;
        z-index: 10;
    }

    .btn-detail {
        background: rgba(99, 102, 241, 0.1);
        color: #ffffff;
        border: 1px solid rgba(99, 102, 241, 0.3);
        border-radius: 12px;
        font-weight: 600;
        padding: 8px 0;
        transition: 0.3s;
    }
    .btn-detail:hover {
        background: #6366f1;
        color: white;
        box-shadow: 0 0 15px rgba(99, 102, 241, 0.4);
    }

    .section-title {
        color: #ffffff !important;
        letter-spacing: -1px;
    }
</style>

{{-- HEADER KATALOG --}}
<div class="mb-5 mt-4">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h2 class="section-title display-5 fw-bold mb-2">Katalog <span class="text-gradient">Gadget</span></h2>
            <p class="custom-muted mb-0">Temukan perangkat terbaik untuk menunjang gaya hidup digital Anda.</p>
        </div>
        {{-- Opsional: Tambahkan Search Bar jika diperlukan di sini --}}
    </div>
</div>

{{-- GRID PRODUK --}}
<div class="row g-4 mb-5">
    @forelse($products as $p)
    <div class="col-6 col-md-4 col-lg-3">
        <div class="glass-card h-100 d-flex flex-column">
            
            {{-- Image & Category --}}
            <div class="product-img-wrapper">
                <span class="category-badge">{{ $p->category->name }}</span>
                @if($p->image)
                    <img src="{{ asset('storage/'.$p->image) }}" alt="{{ $p->name }}">
                @else
                    <div class="h-100 d-flex align-items-center justify-content-center text-white opacity-25">
                        <i class="bi bi-box-seam display-4"></i>
                    </div>
                @endif
            </div>

            {{-- Product Info --}}
            <div class="p-3 p-md-4 d-flex flex-column flex-grow-1">
                <h6 class="text-white fw-bold mb-1 text-truncate" title="{{ $p->name }}">
                    {{ $p->name }}
                </h6>
                
                <p class="text-gradient fw-bold fs-5 mb-4">
                    Rp {{ number_format($p->price,0,',','.') }}
                </p>

                <div class="mt-auto">
                    <a href="{{ route('products.show',$p->id) }}" class="btn btn-detail w-100 d-flex align-items-center justify-content-center">
                        <i class="bi bi-eye me-2"></i> Detail
                    </a>
                </div>
            </div>

        </div>
    </div>
    @empty
    {{-- Jika Produk Kosong --}}
    <div class="col-12 text-center py-5">
        <div class="p-5 glass-card d-inline-block shadow-lg">
            <i class="bi bi-search display-3 custom-muted mb-3 d-block opacity-25"></i>
            <h5 class="text-white">Produk Tidak Ditemukan</h5>
            <p class="custom-muted mb-0">Maaf, saat ini belum ada produk yang tersedia di kategori ini.</p>
        </div>
    </div>
    @endforelse
</div>

@endsection