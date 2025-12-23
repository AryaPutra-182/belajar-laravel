{{-- resources/views/admin/reviews/index.blade.php --}}
@extends('adminlte::page')

@section('title','Ulasan')

@section('content_header')
<h1>Ulasan Produk</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>User</th>
                <th>Produk</th>
                <th>Rating</th>
                <th>Komentar</th>
                <th>Aksi</th>
            </tr>
            @foreach($reviews as $r)
            <tr>
                <td>{{ $r->user->name }}</td>
                <td>{{ $r->product->name }}</td>
                <td>{{ $r->rating }} ⭐</td>
                <td>{{ $r->comment }}</td>
                <td>
                    <form method="POST"
                          action="{{ route('admin.reviews.destroy',$r->id) }}">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Hapus?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@stop
