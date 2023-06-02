<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionCommentsController extends Controller
{
    public function index()
    {
        $comments = Comment::where('user_id', Auth::user()->id)->get();
        return view('session.comments.index', ['comments' => $comments]);
    }

    public function edit(Comment $comment)
    {
        return view('session.comments.edit', [
            'comment' => $comment,
        ]);
    }

    public function update(Comment $comment)
    {
        $attributes = request()->validate([
            'comment' => 'required',
        ]);

        $new_comment['text'] = $attributes['comment'];

        $comment->update($new_comment);

        return redirect()->back()->with('success', 'Comment updated');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->back()->with('success', 'Comment removed');
    }
}
