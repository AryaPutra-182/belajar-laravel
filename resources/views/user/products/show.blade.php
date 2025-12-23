@extends('user.layouts.app')

@section('title',$product->name)

@section('content')
<div class="row">
    <div class="col-md-5">
        @if($product->image)
            <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid">
        @endif
    </div>

    <div class="col-md-7">
        <h2>{{ $product->name }}</h2>
        <p class="text-muted">{{ $product->category->name }}</p>

        <h4 class="text-success">
            Rp {{ number_format($product->price,0,',','.') }}
        </h4>

        <p>{{ $product->description }}</p>

        <p>
            ⭐ {{ number_format($product->avgRating(),1) ?? '0' }}/5
        </p>
    </div>
</div>
@if(auth()->check())
<form method="POST" action="{{ route('checkout.store',$product->id) }}" class="mt-3">
    @csrf
    <div class="input-group">
        <input type="number" name="qty" class="form-control" value="1" min="1">
        <button class="btn btn-success">Checkout</button>
    </div>
</form>
@endif


<hr>

<h4>Ulasan Pengguna</h4>

@foreach($product->reviews as $r)
<div class="border p-3 mb-2">
    <strong>{{ $r->user->name }}</strong> — {{ $r->rating }} ⭐
    <p>{{ $r->comment }}</p>
</div>
@endforeach

@if(auth()->check())
<hr>
<h5>Tulis Ulasan</h5>

<form method="POST" action="{{ route('reviews.store',$product->id) }}">
    @csrf

    <div class="mb-2">
        <select name="rating" class="form-control" required>
            <option value="">Rating</option>
            @for($i=1;$i<=5;$i++)
                <option value="{{ $i }}">{{ $i }} ⭐</option>
            @endfor
        </select>
    </div>

    <div class="mb-2">
        <textarea name="comment" class="form-control" placeholder="Komentar"></textarea>
    </div>

    <button class="btn btn-primary">Kirim Ulasan</button>
</form>
@endif
@endsection
