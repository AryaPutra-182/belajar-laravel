<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Thread;
use App\Models\Comment;

class ForumController extends Controller
{
    public function index()
    {
        $threads = Thread::with('user')
            ->latest()
            ->get();

        return view('admin.forums.index', compact('threads'));
    }

    public function show(Thread $forum)
    {
        $forum->load('user','comments.user');
        return view('admin.forums.show', compact('forum'));
    }

    public function destroy(Thread $forum)
    {
        $forum->delete();
        return back()->with('success','Thread berhasil dihapus');
    }

    public function destroyComment(Comment $comment)
    {
        $comment->delete();
        return back()->with('success','Komentar dihapus');
    }
}
