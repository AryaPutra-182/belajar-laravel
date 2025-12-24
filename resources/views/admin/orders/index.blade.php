@extends('adminlte::page')

@section('title','Pesanan')

@section('content_header')
<h1>Pesanan</h1>
@stop

@section('content')
<table class="table table-bordered">
    <thead>
        <tr>
            <th>User</th>
            <th>Produk</th>
            <th>Total</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
    @foreach($orders as $o)

        {{-- LOOP ITEM DALAM ORDER --}}
        @foreach($o->items as $item)
        <tr>
            <td>
    @if($o->user)
        {{ $o->user->name }}
    @else
        <span class="text-muted fst-italic">User dihapus</span>
    @endif
</td>


            <td>
                @if($item->product)
                    {{ $item->product->name }}
                @else
                    <span class="text-muted fst-italic">
                        Produk sudah dihapus
                    </span>
                @endif
            </td>

            <td>
                Rp {{ number_format($item->price * $item->quantity,0,',','.') }}
            </td>

            <td>
                {{ strtoupper($o->status) }}
            </td>

            <td>
                <form method="POST"
                      action="{{ route('admin.orders.update',$o->id) }}">
                    @csrf
                    @method('PUT')

                    <select name="status"
                            onchange="this.form.submit()"
                            class="form-control form-control-sm">
                        <option value="pending" {{ $o->status=='pending'?'selected':'' }}>
                            pending
                        </option>
                        <option value="paid" {{ $o->status=='paid'?'selected':'' }}>
                            paid
                        </option>
                        <option value="shipped" {{ $o->status=='shipped'?'selected':'' }}>
                            shipped
                        </option>
                        <option value="done" {{ $o->status=='done'?'selected':'' }}>
                            done
                        </option>
                    </select>
                </form>
            </td>
        </tr>
        @endforeach

    @endforeach
    </tbody>
</table>
@endsection
