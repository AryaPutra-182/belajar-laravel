@extends('user.layouts.app')

@section('title', 'Artikel & Insight — TechLife')

@section('content')

<style>
    .glass-card {
        background: #0f172a;
        border: 1px solid #1e293b;
        border-radius: 24px;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
    }
    .glass-card:hover {
        transform: translateY(-10px);
        border-color: #6366f1;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
    }
    .text-gradient {
        background: linear-gradient(to right, #818cf8, #c084fc);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .img-wrapper {
        width: 100%;
        aspect-ratio: 16/9;
        overflow: hidden;
        background: #1e293b;
    }
    .img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .glass-card:hover .img-wrapper img {
        transform: scale(1.1);
    }
    .article-category {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: #818cf8;
        font-weight: 700;
    }
    .btn-read {
        background: rgba(99, 102, 241, 0.1);
        color: #ffffff;
        border: 1px solid rgba(99, 102, 241, 0.3);
        border-radius: 12px;
        padding: 10px;
        font-weight: 600;
        transition: 0.3s;
    }
    .btn-read:hover {
        background: #6366f1;
        color: white;
        box-shadow: 0 0 15px rgba(99, 102, 241, 0.4);
    }
</style>

{{-- HEADER SECTION --}}
<div class="mb-5 mt-4 text-center">
    <h2 class="display-5 fw-bold text-white mb-2">Artikel & <span class="text-gradient">Insight</span></h2>
    <p class="mx-auto text-muted" style="max-width: 600px;">
        Temukan tips terbaru, ulasan mendalam, dan panduan gaya hidup digital yang dikurasi khusus untuk Anda.
    </p>
</div>

{{-- GRID ARTIKEL --}}
<div class="row g-4">
    @forelse($articles as $a)
        <div class="col-md-4">
            <article class="glass-card h-100 d-flex flex-column">
                
                {{-- Thumbnail --}}
                <div class="img-wrapper">
                    @if($a->thumbnail)
                        <img src="{{ asset('storage/'.$a->thumbnail) }}" alt="{{ $a->title }}">
                    @else
                        <div class="h-100 d-flex align-items-center justify-content-center">
                            <i class="bi bi-journal-text text-muted fs-1 opacity-25"></i>
                        </div>
                    @endif
                </div>

                {{-- Content --}}
                <div class="card-body p-4 d-flex flex-column">
                    <div class="article-category mb-2">Tech Update</div>
                    
                    <h5 class="fw-bold text-white mb-3 lh-base">
                        {{ \Illuminate\Support\Str::limit($a->title, 60) }}
                    </h5>

                    <p class="small text-muted mb-4">
                        {{ \Illuminate\Support\Str::limit(strip_tags($a->content), 120) }}
                    </p>

                    <div class="mt-auto">
                        <a href="{{ route('articles.show',$a->id) }}" class="btn btn-read w-100 d-flex align-items-center justify-content-center">
                            Baca Selengkapnya <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>

            </article>
        </div>
    @empty
        {{-- EMPTY STATE --}}
        <div class="col-12 text-center py-5">
            <div class="p-5 glass-card d-inline-block">
                <i class="bi bi-mailbox fs-1 text-muted mb-3 d-block"></i>
                <h5 class="text-white">Belum Ada Artikel</h5>
                <p class="text-muted mb-0">Kembali lagi nanti untuk konten menarik lainnya.</p>
            </div>
        </div>
    @endforelse
</div>

{{-- NEWSLETTER / CTA --}}
<div class="mt-5 p-5 glass-card text-center border-0" style="background: linear-gradient(135deg, rgba(99,102,241,0.1) 0%, rgba(0,0,0,0) 100%);">
    <h4 class="fw-bold text-white mb-3">Ingin update terbaru langsung ke email?</h4>
    <p class="text-muted mb-4">Jangan lewatkan berita teknologi harian dari komunitas TechLife.</p>
    <div class="d-flex justify-content-center gap-2">
        <input type="email" class="form-control bg-dark border-secondary text-white rounded-3 w-50" placeholder="Masukkan email Anda" style="max-width: 300px;">
        <button class="btn btn-primary rounded-3 px-4" style="background: #6366f1; border:none;">Langganan</button>
    </div>
</div>

@endsection