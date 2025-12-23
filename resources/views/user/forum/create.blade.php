{{-- resources/views/user/forum/create.blade.php --}}
@extends('user.layouts.app')

@section('title','Buat Thread')

@section('content')
<h3>Buat Thread</h3>

<form method="POST" action="{{ route('forum.store') }}">
    @csrf
    <div class="mb-2">
        <input name="title" class="form-control" placeholder="Judul" required>
    </div>
    <div class="mb-2">
        <textarea name="body" class="form-control" rows="5"
                  placeholder="Isi diskusi" required></textarea>
    </div>
    <button class="btn btn-primary">Kirim</button>
</form>
@endsection
