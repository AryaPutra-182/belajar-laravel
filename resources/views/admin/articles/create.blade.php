{{-- admin/articles/create.blade.php --}}
@extends('adminlte::page')

@section('title','Tambah Artikel')

@section('content')
<form method="POST" enctype="multipart/form-data"
      action="{{ route('admin.articles.store') }}">
@csrf

<div class="card">
<div class="card-body">

<div class="mb-3">
    <label>Judul</label>
    <input name="title" class="form-control" required>
</div>

<div class="mb-3">
    <label>Konten</label>
    <textarea name="content" rows="6" class="form-control" required></textarea>
</div>

<div class="mb-3">
    <label>Thumbnail</label>
    <input type="file" name="thumbnail" class="form-control">
</div>

<div class="mb-3">
    <label>Produk Terkait</label>
    <select name="products[]" multiple class="form-control">
        @foreach($products as $p)
            <option value="{{ $p->id }}">{{ $p->name }}</option>
        @endforeach
    </select>
</div>

<button class="btn btn-primary">Simpan</button>

</div>
</div>
</form>
@endsection
