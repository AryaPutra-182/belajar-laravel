{{-- admin/categories/edit.blade.php --}}
@extends('adminlte::page')

@section('title','Edit Kategori')

@section('content_header')
    <h1>Edit Kategori</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.categories.update',$category->id) }}">
            @csrf @method('PUT')
            <div class="form-group">
                <label>Nama</label>
                <input name="name" class="form-control" value="{{ $category->name }}" required>
            </div>
            <div class="form-group mt-2">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control">{{ $category->description }}</textarea>
            </div>
            <button class="btn btn-primary mt-3">Update</button>
        </form>
    </div>
</div>
@stop
