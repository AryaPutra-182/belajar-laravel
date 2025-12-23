@extends('adminlte::page')

@section('title','Produk')

@section('content_header')
<h1>Produk</h1>
@stop

@section('content')
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">
    + Tambah Produk
</a>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                 <th>Gambar</th>
                <th>Aksi</th>
               
                
            </tr>
            @foreach($products as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->name }}</td>
                <td>{{ $p->category->name }}</td>
                <td>Rp {{ number_format($p->price,0,',','.') }}</td>
                <td>{{ $p->stock }}</td>
                <td>
                    @if($p->image)
                        <img src="{{ asset('storage/'.$p->image) }}"
                             width="80">
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.products.edit',$p->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.products.destroy',$p->id) }}"
                          method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Hapus?')">Hapus</button>
                    </form>
                </td>

            </tr>
            @endforeach
        </table>
    </div>
</div>
@stop
