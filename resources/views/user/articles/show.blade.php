@extends('user.layouts.app')

@section('title', $article->title . ' — TechLife')

@section('content')

<style>
    .article-container {
        max-width: 900px;
        margin: 0 auto;
    }
    .article-content {
        font-size: 1.15rem;
        line-height: 1.8;
        color: #cbd5e1; /* Slate 300 */
        white-space: pre-line; /* Menjaga spasi antar paragraf */
    }
    .article-thumbnail {
        width: 100%;
        max-height: 500px;
        object-fit: cover;
        border-radius: 2rem;
        border: 1px solid #1e293b;
        margin-bottom: 2.5rem;
        box-shadow: 0 20px 50px rgba(0,0,0,0.5);
    }
    .back-btn {
        color: #818cf8;
        text-decoration: none;
        font-weight: 600;
        transition: 0.3s;
        display: inline-flex;
        align-items: center;
        margin-bottom: 2rem;
    }
    .back-btn:hover {
        color: #ffffff;
        transform: translateX(-5px);
    }
    .glass-card {
        background: #0f172a;
        border: 1px solid #1e293b;
        border-radius: 20px;
        transition: all 0.3s ease;
    }
    .product-card:hover {
        border-color: #6366f1;
        transform: translateY(-5px);
    }
    .section-divider {
        height: 1px;
        background: linear-gradient(to right, transparent, #1e293b, transparent);
        margin: 4rem 0;
    }
    .text-gradient {
        background: linear-gradient(to right, #818cf8, #c084fc);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>

<div class="container py-4">
    <div class="article-container">
        
        {{-- Tombol Kembali --}}
        <a href="{{ route('articles.index') }}" class="back-btn">
            <i class="bi bi-arrow-left me-2"></i> Kembali ke Artikel
        </a>

        {{-- Judul Artikel --}}
        <h1 class="display-4 fw-bold text-white mb-4" style="letter-spacing: -1.5px; line-height: 1.2;">
            {{ $article->title }}
        </h1>

        <div class="d-flex align-items-center mb-5 text-muted small">
                  <span class="me-3 text-white"><i "></i>{{ $article->created_at->format('d M Y') }}</span>
            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-2 rounded-pill">
                Tech Insight
            </span>
        </div>

        {{-- Thumbnail --}}
        @if($article->thumbnail)
            <img src="{{ asset('storage/'.$article->thumbnail) }}" 
                 class="article-thumbnail img-fluid" 
                 alt="{{ $article->title }}">
        @endif

        {{-- Isi Artikel --}}
        <div class="article-content">
            {!! nl2br(e($article->content)) !!}
        </div>

        <div class="section-divider"></div>

        {{-- PRODUK TERKAIT --}}
        @if($article->products->count() > 0)
        <div class="related-products-section">
            <h4 class="fw-bold text-white mb-4">
                <i class="bi bi-bag-plus me-2 text-gradient"></i> Produk Terkait Dalam Artikel
            </h4>

            <div class="row g-4">
                @foreach($article->products as $p)
                <div class="col-md-4 col-6">
                    <div class="glass-card product-card h-100 p-3">
                        <div class="rounded-4 overflow-hidden mb-3" style="aspect-ratio: 1/1; background: #1e293b;">
                            @if($p->image)
                                <img src="{{ asset('storage/'.$p->image) }}" 
                                     class="w-100 h-100" style="object-fit: cover;">
                            @else
                                <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                    <i class="bi bi-box-seam fs-2 text-muted"></i>
                                </div>
                            @endif
                        </div>
                        
                        <h6 class="text-white fw-bold text-truncate mb-1">{{ $p->name }}</h6>
                        <p class="text-gradient fw-bold mb-3 small">
                            Rp {{ number_format($p->price,0,',','.') }}
                        </p>
                        
                        <a href="{{ route('products.show',$p->id) }}" 
                           class="btn btn-sm btn-outline-light w-100 rounded-3 border-secondary border-opacity-25 py-2 fw-semibold">
                            Lihat Produk
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</div>

@endsection