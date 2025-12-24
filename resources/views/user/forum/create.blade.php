@extends('user.layouts.app')

@section('title', 'Buat Thread Baru — Forum TechLife')

@section('content')

<style>
    /* GLOBAL CONTRAST FIX */
    .form-container {
        max-width: 800px;
        margin: 0 auto;
    }

    .glass-card {
        background: #0f172a; /* Slate 900 */
        border: 1px solid #1e293b;
        border-radius: 24px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
    }

    .text-gradient {
        background: linear-gradient(to right, #818cf8, #c084fc);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Memperbaiki teks yang tadinya redup menjadi terang */
    .bright-muted {
        color: #94a3b8 !important; /* Slate 400 - Abu-abu terang agar kelihatan */
    }

    /* Custom Input Styling */
    .form-control-dark {
        background-color: #020617;
        border: 1px solid #1e293b;
        color: #ffffff;
        border-radius: 15px;
        padding: 1rem 1.2rem;
        transition: all 0.3s ease;
    }

    .form-control-dark:focus {
        background-color: #020617;
        border-color: #6366f1;
        color: #ffffff;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    /* Warna placeholder agar terlihat tapi tidak terlalu terang */
    .form-control-dark::placeholder {
        color: #64748b; 
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

    /* Label harus putih/terang agar terlihat */
    label {
        color: #f1f5f9; 
        font-weight: 700;
        margin-bottom: 0.6rem;
        font-size: 0.95rem;
    }

    .tip-box {
        background: rgba(99, 102, 241, 0.08);
        border: 1px solid rgba(99, 102, 241, 0.2);
        border-radius: 15px;
        padding: 1.5rem;
    }
</style>

<div class="form-container py-5">
    
    {{-- Tombol Kembali --}}
    <div class="mb-4">
        <a href="{{ route('forum.index') }}" class="back-link">
            <i class="bi bi-arrow-left me-2"></i> Kembali ke Forum
        </a>
    </div>

    <div class="glass-card p-4 p-md-5">
        
        <h2 class="fw-bold text-white mb-2">Mulai <span class="text-gradient">Diskusi Baru</span></h2>
        <p class="bright-muted mb-5">Bagikan pertanyaan atau pengalamanmu dengan komunitas.</p>

        <form method="POST" action="{{ route('forum.store') }}">
            @csrf
            
            {{-- Judul Thread --}}
            <div class="mb-4">
                <label for="title">Judul Diskusi</label>
                <input type="text" 
                       name="title" 
                       id="title"
                       class="form-control form-control-dark" 
                       placeholder="Contoh: Rekomendasi Laptop untuk Desain Grafis" 
                       required 
                       autocomplete="off">
                <div class="bright-muted small mt-2"><i class="bi bi-info-circle me-1"></i> Buat judul yang spesifik agar orang lain tertarik menjawab.</div>
            </div>

            {{-- Isi Body --}}
            <div class="mb-4">
                <label for="body">Isi Diskusi</label>
                <textarea name="body" 
                          id="body"
                          class="form-control form-control-dark" 
                          rows="8" 
                          placeholder="Jelaskan secara detail apa yang ingin Anda diskusikan..." 
                          required></textarea>
            </div>

            {{-- Tips Box --}}
            <div class="tip-box mb-5">
                <h6 class="text-white fw-bold mb-3 small text-uppercase tracking-wider">
                    <i class="bi bi-lightbulb-fill me-2 text-warning"></i> Aturan Komunitas
                </h6>
                <ul class="bright-muted small mb-0 ps-3">
                    <li class="mb-2">Gunakan judul yang informatif.</li>
                    <li class="mb-2">Dilarang spam, promosi, atau menyinggung SARA.</li>
                    <li>Sertakan gambar/link jika diperlukan untuk memperjelas topik.</li>
                </ul>
            </div>

            {{-- Button Actions --}}
            <div class="d-flex align-items-center justify-content-between">
                <a href="{{ route('forum.index') }}" class="bright-muted text-decoration-none fw-bold small">Batal</a>
                <button type="submit" class="btn btn-primary px-5 py-3 rounded-4 fw-bold shadow-lg" style="background: #6366f1; border: none;">
                    Posting Sekarang <i class="bi bi-send-fill ms-2"></i>
                </button>
            </div>
        </form>

    </div>
</div>

@endsection