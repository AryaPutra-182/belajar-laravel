@extends('user.layouts.app')

@section('title', $thread->title . ' — Forum TechLife')

@section('content')

<style>
    /* Global Text Contrast */
    body {
        color: #cbd5e1; /* Slate 300 */
    }

    .forum-container {
        max-width: 900px;
        margin: 0 auto;
    }

    .glass-card {
        background: #0f172a;
        border: 1px solid #1e293b;
        border-radius: 24px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .thread-title {
        color: #ffffff !important;
        letter-spacing: -1px;
        line-height: 1.2;
    }

    .thread-body {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #e2e8f0; /* Slate 200 - Lebih terang untuk isi utama */
        white-space: pre-line;
    }

    /* Menangani Teks Kecil yang Sering Tidak Terlihat */
    .custom-muted {
        color: #94a3b8 !important; /* Slate 400 - Abu-abu terang */
    }

    .comment-card {
        background: rgba(30, 41, 59, 0.4);
        border-left: 4px solid #6366f1;
        border-radius: 16px;
        transition: 0.3s;
    }
    
    .comment-card:hover {
        background: rgba(30, 41, 59, 0.6);
        transform: translateX(5px);
    }

    .user-avatar {
        width: 45px;
        height: 45px;
        background: linear-gradient(135deg, #6366f1, #a855f7);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        color: white;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    .form-control-dark {
        background-color: #020617;
        border: 1px solid #1e293b;
        color: #ffffff;
        border-radius: 18px;
        padding: 1.2rem;
        transition: 0.3s;
    }

    .form-control-dark:focus {
        background-color: #020617;
        border-color: #6366f1;
        color: #ffffff;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    .back-link {
        color: #94a3b8;
        text-decoration: none;
        font-weight: 700;
        transition: 0.3s;
        display: inline-flex;
        align-items: center;
    }

    .back-link:hover {
        color: #ffffff;
        transform: translateX(-5px);
    }
</style>

<div class="forum-container py-4">
    
    {{-- Navigasi Kembali --}}
    <div class="mb-4">
        <a href="{{ route('forum.index') }}" class="back-link">
            <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Forum
        </a>
    </div>

    {{-- THREAD UTAMA --}}
    <div class="glass-card p-4 p-md-5 mb-5 border-0 shadow-lg">
        <div class="d-flex align-items-center mb-4">
            <div class="user-avatar me-3 shadow">
                {{ strtoupper(substr($thread->user->name, 0, 1)) }}
            </div>
            <div>
                <h6 class="mb-0 text-white fw-bold">{{ $thread->user->name }}</h6>
                <small class="custom-muted"><i class="bi bi-clock me-1"></i> Ditanyakan {{ $thread->created_at->diffForHumans() }}</small>
            </div>
        </div>

        <h2 class="thread-title fw-bold mb-4">{{ $thread->title }}</h2>
        
        <div class="thread-body mb-4">
            {{ $thread->body }}
        </div>
        
        <div class="pt-4 border-top border-secondary border-opacity-10">
            <span class="badge rounded-pill px-3 py-2" style="background: rgba(99,102,241,0.1); color: #818cf8; border: 1px solid rgba(99,102,241,0.2);">
                <i class="bi bi-chat-left-dots-fill me-2"></i>{{ $thread->comments->count() }} Diskusi Aktif
            </span>
        </div>
    </div>

    {{-- BAGIAN KOMENTAR --}}
    <div class="d-flex align-items-center mb-4">
        <div class="vr me-3" style="width: 4px; background-color: #6366f1; border-radius: 2px; height: 25px; opacity: 1;"></div>
        <h4 class="fw-bold text-white mb-0">Diskusi Komunitas</h4>
    </div>

    @if(session('success'))
        <div class="alert alert-success bg-success bg-opacity-10 border-success border-opacity-25 text-success rounded-4 mb-4 shadow-sm">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="mb-5">
        @foreach($thread->comments as $c)
        <div class="comment-card p-4 mb-3 shadow-sm">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="d-flex align-items-center">
                    <div class="user-avatar me-2 shadow-sm" style="width: 32px; height: 32px; font-size: 0.75rem; border-radius: 8px;">
                        {{ strtoupper(substr($c->user->name, 0, 1)) }}
                    </div>
                    <span class="text-white fw-bold small me-2">{{ $c->user->name }}</span>
                    <span class="custom-muted" style="font-size: 0.75rem;">• {{ $c->created_at->diffForHumans() }}</span>
                </div>

                @auth
                    @if(auth()->id() === $c->user_id)
                    <form method="POST" action="{{ route('comments.destroy', $c->id) }}" onsubmit="return confirm('Hapus komentar ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-link text-danger p-0 text-decoration-none opacity-75">
                            <i class="bi bi-trash3"></i>
                        </button>
                    </form>
                    @endif
                @endauth
            </div>
            <div class="ps-1" style="color: #e2e8f0; font-size: 0.95rem; line-height: 1.6;">
                {{ $c->body }}
            </div>
        </div>
        @endforeach
    </div>

    {{-- FORM INPUT KOMENTAR --}}
    @auth
    <div class="glass-card p-4 p-md-5 border-0 shadow-lg">
        <h5 class="fw-bold text-white mb-4">Bagikan Jawaban Anda</h5>
        <form method="POST" action="{{ route('forum.comment',$thread->id) }}">
            @csrf
            <textarea name="body" class="form-control form-control-dark mb-4" rows="4" placeholder="Tuliskan solusi atau pendapat Anda di sini..." required></textarea>
            <div class="text-end">
                <button class="btn btn-primary px-5 py-3 rounded-4 fw-bold shadow-sm" style="background: #6366f1; border: none;">
                    Kirim Komentar <i class="bi bi-send-fill ms-2 small"></i>
                </button>
            </div>
        </form>
    </div>
    @else
    <div class="glass-card p-5 text-center border-0 shadow-lg">
        <i class="bi bi-lock-fill text-muted display-6 mb-3 d-block opacity-50"></i>
        <p class="custom-muted mb-0 fs-5">Tertarik untuk bergabung dalam diskusi? <br> 
            <a href="{{ route('login') }}" class="text-primary text-decoration-none fw-bold">Login Sekarang</a>
        </p>
    </div>
    @endauth

</div>

@endsection