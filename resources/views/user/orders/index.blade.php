@extends('user.layouts.app')

@section('title','Pesanan Saya')

@section('content')
<h3>Pesanan Saya</h3>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>Produk</th>
        <th>Qty</th>
        <th>Total</th>
        <th>Status</th>
    </tr>
    @foreach($orders as $o)
    <tr>
        <td>{{ $o->product->name }}</td>
        <td>{{ $o->qty }}</td>
        <td>Rp {{ number_format($o->total,0,',','.') }}</td>
        <td>
            <span class="badge bg-secondary">{{ $o->status }}</span>
        </td>
    </tr>
    @endforeach
</table>
@endsection
