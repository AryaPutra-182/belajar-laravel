<?php

// app/Http/Controllers/ThreadController.php
namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function index() {
        $threads = Thread::with('user')->latest()->get();
        return view('user.forum.index', compact('threads'));
    }

    public function create() {
        return view('user.forum.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|max:150',
            'body'  => 'required',
        ]);

        Thread::create([
            'user_id' => auth()->id(),
            'title'   => $request->title,
            'body'    => $request->body,
        ]);

        return redirect()->route('forum.index')
            ->with('success','Thread berhasil dibuat');
    }

    public function show(Thread $thread) {
        $thread->load('user','comments.user');
        return view('user.forum.show', compact('thread'));
    }
}
