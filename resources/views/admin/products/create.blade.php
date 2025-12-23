@extends('adminlte::page')

@section('title','Tambah Produk')

@section('content_header')
<h1>Tambah Produk</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">

        <form method="POST"
              action="{{ route('admin.products.store') }}"
              enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Nama</label>
                <input name="name" class="form-control" required>
            </div>

            <div class="form-group mt-2">
                <label>Kategori</label>
                <select name="category_id" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mt-2">
                <label>Harga</label>
                <input name="price" type="number" class="form-control" required>
            </div>

            <div class="form-group mt-2">
                <label>Stok</label>
                <input name="stock" type="number" class="form-control" required>
            </div>

            <div class="form-group mt-2">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <div class="form-group mt-2">
                <label>Gambar Produk</label>
                <input type="file" name="image" class="form-control">
            </div>

            <button class="btn btn-primary mt-3">Simpan</button>
        </form>

    </div>
</div>
@stop
