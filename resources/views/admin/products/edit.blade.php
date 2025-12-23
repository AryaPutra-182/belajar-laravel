@extends('adminlte::page')

@section('title','Edit Produk')

@section('content_header')
<h1>Edit Produk</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">

        <form method="POST"
              action="{{ route('admin.products.update',$product->id) }}"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama</label>
                <input name="name"
                       class="form-control"
                       value="{{ $product->name }}"
                       required>
            </div>

            <div class="form-group mt-2">
                <label>Kategori</label>
                <select name="category_id" class="form-control" required>
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}"
                            {{ $product->category_id == $c->id ? 'selected' : '' }}>
                            {{ $c->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mt-2">
                <label>Harga</label>
                <input name="price"
                       type="number"
                       class="form-control"
                       value="{{ $product->price }}"
                       required>
            </div>

            <div class="form-group mt-2">
                <label>Stok</label>
                <input name="stock"
                       type="number"
                       class="form-control"
                       value="{{ $product->stock }}"
                       required>
            </div>

            <div class="form-group mt-2">
                <label>Deskripsi</label>
                <textarea name="description"
                          class="form-control">{{ $product->description }}</textarea>
            </div>

            <div class="form-group mt-2">
                <label>Gambar Produk</label>
                <input type="file" name="image" class="form-control">
            </div>

            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}"
                     width="120"
                     class="mt-2">
            @endif

            <button class="btn btn-primary mt-3">Update</button>
        </form>

    </div>
</div>
@stop
