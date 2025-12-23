{{-- resources/views/user/forum/show.blade.php --}}
@extends('user.layouts.app')

@section('title',$thread->title)

@section('content')
<h3>{{ $thread->title }}</h3>
<p class="text-muted">oleh {{ $thread->user->name }}</p>

<div class="border p-3 mb-4">
    {{ $thread->body }}
</div>

<h5>Komentar</h5>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@foreach($thread->comments as $c)
<div class="border p-2 mb-2 rounded">
    <strong>{{ $c->user->name }}</strong>
    <p class="mb-1">{{ $c->body }}</p>

    @auth
        @if(auth()->id() === $c->user_id)
            <form method="POST"
                  action="{{ route('comments.destroy', $c->id) }}"
                  onsubmit="return confirm('Hapus komentar ini?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger">Hapus</button>
            </form>
        @endif
    @endauth
</div>
@endforeach


<form method="POST" action="{{ route('forum.comment',$thread->id) }}">
    @csrf

    <textarea name="body"
              class="form-control mb-2"
              placeholder="Tulis komentar..."
              required></textarea>

    <button class="btn btn-sm btn-success">Kirim</button>
</form>

@endsection
