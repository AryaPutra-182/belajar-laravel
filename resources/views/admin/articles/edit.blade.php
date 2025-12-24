@extends('adminlte::page')

@section('title','Edit Artikel')

@section('content_header')
<h1>Edit Artikel</h1>
@stop

@section('content')

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<form method="POST"
      action="{{ route('admin.articles.update',$article->id) }}"
      enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="card">
<div class="card-body">

<div class="mb-3">
    <label>Judul</label>
    <input name="title"
           value="{{ old('title',$article->title) }}"
           class="form-control" required>
</div>

<div class="mb-3">
    <label>Konten</label>
    <textarea name="content" rows="6"
              class="form-control" required>{{ old('content',$article->content) }}</textarea>
</div>

<div class="mb-3">
    <label>Thumbnail</label>
    <input type="file" name="thumbnail" class="form-control">

    @if($article->thumbnail)
        <img src="{{ asset('storage/'.$article->thumbnail) }}"
             class="img-fluid mt-2"
             style="max-height:150px">
    @endif
</div>

<div class="mb-3">
    <label>Produk Terkait</label>
    <select name="products[]" multiple class="form-control">
        @foreach($products as $p)
            <option value="{{ $p->id }}"
                {{ $article->products->contains($p->id) ? 'selected' : '' }}>
                {{ $p->name }}
            </option>
        @endforeach
    </select>
</div>

<button class="btn btn-primary">Update Artikel</button>
<a href="{{ route('admin.articles.index') }}"
   class="btn btn-secondary">Kembali</a>

</div>
</div>
</form>
@stop
