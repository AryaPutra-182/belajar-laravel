@extends('adminlte::page')

@section('title','Detail Artikel')

@section('content_header')
<h1>Detail Artikel</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">

        <h3 class="fw-bold">{{ $article->title }}</h3>

        <p class="text-muted">
            Dibuat: {{ $article->created_at->format('d M Y') }}
        </p>

        @if($article->thumbnail)
            <img src="{{ asset('storage/'.$article->thumbnail) }}"
                 class="img-fluid mb-3"
                 style="max-height:250px">
        @endif

        <hr>

        <p style="white-space: pre-line;">
            {{ $article->content }}
        </p>

        <hr>

        <h5>Produk Terkait</h5>

        @if($article->products->count())
            <ul>
                @foreach($article->products as $p)
                    <li>
                        {{ $p->name }} —
                        <strong>
                            Rp {{ number_format($p->price,0,',','.') }}
                        </strong>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-muted">Tidak ada produk terkait</p>
        @endif

        <a href="{{ route('admin.articles.edit',$article->id) }}"
           class="btn btn-warning">
            Edit Artikel
        </a>

        <a href="{{ route('admin.articles.index') }}"
           class="btn btn-secondary">
            Kembali
        </a>

    </div>
</div>

@stop
