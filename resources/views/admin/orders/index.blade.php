@extends('adminlte::page')

@section('title','Pesanan')

@section('content_header')
<h1>Pesanan</h1>
@stop

@section('content')
<table class="table table-bordered">
    <tr>
        <th>User</th>
        <th>Produk</th>
        <th>Total</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    @foreach($orders as $o)
    <tr>
        <td>{{ $o->user->name }}</td>
        <td>{{ $o->product->name }}</td>
        <td>Rp {{ number_format($o->total,0,',','.') }}</td>
        <td>{{ $o->status }}</td>
        <td>
            <form method="POST" action="{{ route('admin.orders.update',$o->id) }}">
                @csrf @method('PUT')
                <select name="status" onchange="this.form.submit()">
                    <option {{ $o->status=='pending'?'selected':'' }}>pending</option>
                    <option {{ $o->status=='paid'?'selected':'' }}>paid</option>
                    <option {{ $o->status=='shipped'?'selected':'' }}>shipped</option>
                    <option {{ $o->status=='done'?'selected':'' }}>done</option>
                </select>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
