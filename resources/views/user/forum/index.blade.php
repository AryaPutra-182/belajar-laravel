@extends('user.layouts.app')

@section('title', 'Forum Diskusi TechLife')

@section('content')

<style>
    /* Mengatur warna dasar teks agar tidak ada yang tersembunyi */
    body {
        color: #cbd5e1; /* Slate 300 - Sangat mudah dibaca di bg gelap */
    }

    .glass-card {
        background: #0f172a;
        border: 1px solid #1e293b;
        border-radius: 20px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .glass-card:hover {
        border-color: #6366f1;
        transform: scale(1.01);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    .text-gradient {
        background: linear-gradient(to right, #818cf8, #c084fc);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .thread-link {
        color: #ffffff !important; /* Putih murni agar judul sangat jelas */
        text-decoration: none;
        transition: 0.2s;
        font-weight: 700;
    }
    .thread-link:hover {
        color: #818cf8 !important;
    }

    /* Memperbaiki warna teks yang redup agar tetap terlihat */
    .custom-muted {
        color: #94a3b8 !important; /* Slate 400 - Abu-abu yang cukup terang */
    }

    .user-badge {
        background: rgba(99, 102, 241, 0.1); /* Sedikit warna indigo transparan */
        color: #818cf8; /* Warna indigo terang */
        padding: 4px 12px;
        border-radius: 8px;
        font-size: 0.8rem;
        border: 1px solid rgba(99, 102, 241, 0.2);
        font-weight: 600;
    }

    .icon-circle {
        width: 45px;
        height: 45px;
        background: rgba(99, 102, 241, 0.1);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6366f1;
    }
</style>

{{-- HEADER FORUM --}}
<div class="row align-items-center mb-5 mt-4 g-4">
    <div class="col-md-8">
        <h2 class="display-5 fw-bold text-white mb-2">Forum <span class="text-gradient">Komunitas</span></h2>
        <p class="custom-muted mb-0">Tempat berbagi solusi, rekomendasi gadget, dan diskusi teknologi terkini.</p>
    </div>
    <div class="col-md-4 text-md-end">
        <a href="{{ route('forum.create') }}" class="btn btn-primary px-4 py-2 rounded-3 fw-bold shadow" style="background: #6366f1; border: none;">
            <i class="bi bi-plus-lg me-2"></i> Buat Thread Baru
        </a>
    </div>
</div>

{{-- LIST THREAD --}}
<div class="row">
    <div class="col-lg-9 mx-auto">
        @forelse($threads as $t)
            <div class="glass-card p-4 mb-3 d-flex align-items-start gap-3 shadow-sm">
                {{-- Icon Decor --}}
                <div class="icon-circle d-none d-sm-flex shadow-sm">
                    <i class="bi bi-chat-left-text-fill fs-5"></i>
                </div>

                <div class="flex-grow-1">
                    <h5 class="mb-2">
                        <a href="{{ route('forum.show',$t->id) }}" class="thread-link">
                            {{ $t->title }}
                        </a>
                    </h5>
                    
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <span class="user-badge shadow-sm">
                            <i class="bi bi-person-fill me-1"></i> {{ $t->user->name }}
                        </span>
                        <span class="small custom-muted">
                            <i class="bi bi-clock-history me-1"></i> {{ $t->created_at->diffForHumans() }}
                        </span>
                        <span class="small custom-muted ms-auto d-none d-md-inline">
                            <i class="bi bi-chat-dots me-1"></i> {{ $t->comments->count() }} Diskusi
                        </span>
                    </div>
                </div>

                {{-- Action Arrow --}}
                <div class="align-self-center ps-2">
                    <a href="{{ route('forum.show',$t->id) }}" class="text-white-50">
                        <i class="bi bi-chevron-right fs-4"></i>
                    </a>
                </div>
            </div>
        @empty
            {{-- State Jika Kosong --}}
            <div class="text-center py-5 glass-card">
                <i class="bi bi-chat-dots-fill display-1 custom-muted opacity-25 mb-4 d-block"></i>
                <h4 class="text-white">Belum Ada Diskusi</h4>
                <p class="custom-muted">Jadilah yang pertama memulai percakapan di komunitas ini.</p>
                <a href="{{ route('forum.create') }}" class="btn btn-outline-primary btn-sm rounded-pill px-4 mt-2">
                    Mulai Diskusi
                </a>
            </div>
        @endforelse
    </div>
</div>

@endsection