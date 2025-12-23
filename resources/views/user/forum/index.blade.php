{{-- resources/views/user/forum/index.blade.php --}}
@extends('user.layouts.app')

@section('title','Forum')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Forum Diskusi</h3>
    <a href="{{ route('forum.create') }}" class="btn btn-primary">Buat Thread</a>
</div>

@foreach($threads as $t)
<div class="card mb-2">
    <div class="card-body">
        <h5>
            <a href="{{ route('forum.show',$t->id) }}">{{ $t->title }}</a>
        </h5>
        <small class="text-muted">
            oleh {{ $t->user->name }} • {{ $t->created_at->diffForHumans() }}
        </small>
    </div>
</div>
@endforeach
@endsection
