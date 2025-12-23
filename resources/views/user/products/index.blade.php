@extends('user.layouts.app')

@section('title','Katalog Produk')

@section('content')
<div class="row">
    @foreach($products as $p)
    <div class="col-md-3 mb-4">
        <div class="card h-100">
            @if($p->image)
                <img src="{{ asset('storage/'.$p->image) }}" class="card-img-top">
            @endif

            <div class="card-body">
                <h6>{{ $p->name }}</h6>
                <small class="text-muted">{{ $p->category->name }}</small>
                <p class="mt-2 fw-bold">
                    Rp {{ number_format($p->price,0,',','.') }}
                </p>
                <a href="{{ route('products.show',$p->id) }}" class="btn btn-sm btn-primary">
                    Detail
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
