{{-- admin/categories/create.blade.php --}}
@extends('adminlte::page')

@section('title','Tambah Kategori')

@section('content_header')
    <h1>Tambah Kategori</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf
            <div class="form-group">
                <label>Nama</label>
                <input name="name" class="form-control" required>
            </div>
            <div class="form-group mt-2">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <button class="btn btn-primary mt-3">Simpan</button>
        </form>
    </div>
</div>
@stop
