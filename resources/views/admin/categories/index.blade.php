{{-- admin/categories/index.blade.php --}}
@extends('adminlte::page')

@section('title','Kategori')

@section('content_header')
    <h1>Kategori</h1>
@stop

@section('content')
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">
    + Tambah Kategori
</a>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
            @foreach($categories as $c)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $c->name }}</td>
                <td>
                    <a href="{{ route('admin.categories.edit',$c->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.categories.destroy',$c->id) }}"
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
