@extends('adminlte::page')

@section('title','Detail Forum')

@section('content_header')
<h1>{{ $forum->title }}</h1>
@stop

@section('content')

<div class="card mb-3">
    <div class="card-body">
        <strong>{{ $forum->user->name }}</strong>
        <p class="mt-2">{{ $forum->body }}</p>
    </div>
</div>

<h5>Komentar</h5>

@foreach($forum->comments as $c)
<div class="border p-2 mb-2">
    <strong>{{ $c->user->name }}</strong>
    <p>{{ $c->body }}</p>

    <form method="POST"
          action="{{ route('admin.forums.comments.destroy',$c->id) }}">
        @csrf @method('DELETE')
        <button class="btn btn-sm btn-danger"
                onclick="return confirm('Hapus komentar?')">
            Hapus
        </button>
    </form>
</div>
@endforeach

@stop
