<?php

// app/Http/Controllers/CommentController.php
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Thread;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Thread $thread) {
        $request->validate(['body'=>'required']);

        Comment::create([
            'thread_id' => $thread->id,
            'user_id'   => auth()->id(),
            'body'      => $request->body,
        ]);

        return back();
    }
    public function destroy(Comment $comment) {
        $comment->delete();
        return back()->with('success','Komentar dihapus');
    }
}

