@extends('adminlte::page')

@section('title','Artikel')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>Manajemen Artikel</h1>
    <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">
        + Tambah Artikel
    </a>
</div>
@stop

@section('content')

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th width="80">Thumbnail</th>
                    <th>Judul</th>
                    <th>Produk Terkait</th>
                    <th>Dibuat</th>
                    <th width="160">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($articles as $a)
                <tr>
                    <td>
                        @if($a->thumbnail)
                            <img src="{{ asset('storage/'.$a->thumbnail) }}"
                                 style="height:50px; width:70px; object-fit:cover"
                                 class="rounded">
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>

                    <td>
                        <strong>{{ $a->title }}</strong>
                    </td>

                    <td>
                        @if($a->products->count())
                            @foreach($a->products as $p)
                                <span class="badge bg-secondary">
                                    {{ $p->name }}
                                </span>
                            @endforeach
                        @else
                            <span class="text-muted">Tidak ada</span>
                        @endif
                    </td>

                    <td>
                        {{ $a->created_at->format('d M Y') }}
                    </td>

                    <td>
                        <a href="{{ route('admin.articles.show',$a->id) }}"
                           class="btn btn-sm btn-info">
                            Lihat
                        </a>

                        <a href="{{ route('admin.articles.edit',$a->id) }}"
                           class="btn btn-sm btn-warning">
                            Edit
                        </a>

                        <form action="{{ route('admin.articles.destroy',$a->id) }}"
                              method="POST"
                              style="display:inline"
                              onsubmit="return confirm('Hapus artikel ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        Belum ada artikel
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@stop
