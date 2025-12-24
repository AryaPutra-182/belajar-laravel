@extends('user.layouts.app')

@section('title', 'Pesanan Saya — TechLife')

@section('content')

<style>
    /* Global Reset & Visibility */
    body { background-color: #020617; color: #e2e8f0; }

    .glass-card {
        background: #0f172a;
        border: 1px solid #1e293b;
        border-radius: 24px;
        overflow: hidden;
    }

    .section-title {
        color: #ffffff !important;
        font-weight: 800;
        letter-spacing: -1.5px;
    }

    /* Table Styling - Transparan & Kontras Tinggi */
    .table-dark-modern {
        color: #e2e8f0;
        margin-bottom: 0;
        background-color: transparent !important;
    }

    .table-dark-modern thead th {
        background: rgba(255, 255, 255, 0.05) !important;
        color: #ffffff;
        border-bottom: 1px solid #334155;
        padding: 1.2rem 1rem;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .table-dark-modern td {
        background-color: transparent !important; 
        color: #cbd5e1 !important;
        padding: 1.2rem 1rem;
        border-bottom: 1px solid #1e293b;
        vertical-align: middle;
    }

    .status-badge {
        padding: 8px 16px;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 800;
        border: 1px solid transparent;
        display: inline-flex;
        align-items: center;
    }
    .status-pending { background: rgba(245, 158, 11, 0.15); color: #fbbf24; border-color: rgba(245, 158, 11, 0.3); }
    .status-success { background: rgba(16, 185, 129, 0.15); color: #34d399; border-color: rgba(16, 185, 129, 0.3); }
    .status-failed { background: rgba(239, 68, 68, 0.15); color: #f87171; border-color: rgba(239, 68, 68, 0.3); }

    .img-thumb {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 12px;
        border: 1px solid #334155;
    }

    /* Button Styling */
    .btn-review {
        background: #6366f1;
        color: white;
        border: none;
        font-weight: 700;
        transition: 0.3s;
    }
    .btn-review:hover {
        background: #4f46e5;
        box-shadow: 0 0 15px rgba(99, 102, 241, 0.4);
        color: white;
    }

    .custom-muted { color: #94a3b8 !important; }
</style>

<div class="container py-4">
    
    <div class="mb-5 mt-2">
        <h2 class="section-title mb-2">Riwayat <span style="color: #6366f1;">Pesanan</span></h2>
        <p class="custom-muted">Pantau status pengiriman dan riwayat transaksi Anda di sini.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success bg-success bg-opacity-10 border-success border-opacity-25 text-success rounded-4 mb-4">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="glass-card shadow-lg">
        <div class="table-responsive">
            <table class="table table-dark-modern border-0">
                <thead>
                    <tr>
                        <th class="border-0">Produk</th>
                        <th class="text-center border-0">Jumlah</th>
                        <th class="border-0">Total Harga</th>
                        <th class="border-0">Status Pesanan</th>
                        <th class="text-end border-0">Aksi</th>
                    </tr>
                </thead>
               <tbody>
@forelse($orders as $o)

    @foreach($o->items as $item)
    <tr>
        <td>
            <div class="d-flex align-items-center">
                @if($item->product && $item->product->image)
                    <img src="{{ asset('storage/'.$item->product->image) }}"
                         class="img-thumb me-3" alt="thumb">
                @else
                    <div class="img-thumb me-3 bg-secondary bg-opacity-10 d-flex align-items-center justify-content-center">
                        <i class="bi bi-box text-muted"></i>
                    </div>
                @endif

                <div>
                    <h6 class="text-white mb-0 fw-bold">
                        {{ $item->product->name ?? 'Produk tidak tersedia' }}
                    </h6>
                    <small class="custom-muted" style="font-size: 0.7rem;">
                        ID Pesanan: #TL{{ $o->id + 1000 }}
                    </small>
                </div>
            </div>
        </td>

        <td class="text-center fw-bold text-white">
            {{ $item->quantity }}
        </td>

        <td>
            <span class="text-white fw-bold">
                Rp {{ number_format($item->price * $item->quantity,0,',','.') }}
            </span>
        </td>

        <td>
            @php
                $statusLower = strtolower($o->status);
                $statusClass = match($statusLower) {
                    'pending' => 'status-pending',
                    'selesai','done','dibayar' => 'status-success',
                    'dibatalkan' => 'status-failed',
                    default => 'status-pending'
                };
            @endphp
            <span class="status-badge {{ $statusClass }}">
                <i class="bi bi-circle-fill me-2" style="font-size: 0.5rem;"></i>
                {{ strtoupper($o->status) }}
            </span>
        </td>

        <td class="text-end">
            <div class="d-flex justify-content-end gap-2">
                @if(in_array($statusLower,['selesai','done']))
                    <a href="{{ route('products.show', $item->product_id) }}#review-section"
                       class="btn btn-sm btn-review rounded-pill px-3">
                        <i class="bi bi-star-fill me-1"></i> Review
                    </a>
                @endif

                <a href="{{ route('products.show', $item->product_id) }}"
                   class="btn btn-sm btn-outline-light rounded-pill px-3 border-secondary border-opacity-50">
                    <i class="bi bi-arrow-repeat me-1"></i> Reorder
                </a>
            </div>
        </td>
    </tr>
    @endforeach

@empty
<tr>
    <td colspan="5" class="text-center py-5">
        <div class="py-4">
            <i class="bi bi-bag-x display-4 custom-muted opacity-25 mb-3 d-block"></i>
            <h5 class="text-white">Belum ada pesanan</h5>
            <a href="{{ route('home') }}"
               class="btn btn-primary rounded-pill px-4 mt-2"
               style="background:#6366f1;border:none;">
                Mulai Belanja
            </a>
        </div>
    </td>
</tr>
@endforelse
</tbody>

            </table>
        </div>
    </div>
</div>

@endsection