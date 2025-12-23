@extends('adminlte::page')

@section('title','Moderasi Forum')

@section('content_header')
<h1>Moderasi Forum</h1>
@stop

@section('content')

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>Judul</th>
        <th>User</th>
        <th>Dibuat</th>
        <th>Aksi</th>
    </tr>

    @foreach($threads as $t)
    <tr>
        <td>{{ $t->title }}</td>
        <td>{{ $t->user->name }}</td>
        <td>{{ $t->created_at->diffForHumans() }}</td>
        <td>
            <a href="{{ route('admin.forums.show',$t->id) }}"
               class="btn btn-sm btn-info">
                Lihat
            </a>

            <form method="POST"
                  action="{{ route('admin.forums.destroy',$t->id) }}"
                  style="display:inline">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger"
                        onclick="return confirm('Hapus thread?')">
                    Hapus
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@stop
