<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Book;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthCommentsController extends Controller
{
    public function index()
    {
        // get all comments for the current user

        return view('session.comments.index', [
            'comments' => Comment::where('user_id', Auth::user()->id)->get(),
        ]);
    }

    public function edit(Comment $comment)
    {
        // view to update one comment
        return view('session.comments.edit', [
            'comment' => $comment,
        ]);
    }

    public function update(Comment $comment)
    {
        // endpoint for comment update form
        // validate and format form data
        $attributes = request()->validate([
            'comment' => 'required',
        ]);
        $attributes = Helpers::renameAttribute('comment', 'text', $attributes);

        // update comment and redirect with message
        $comment->update($attributes);
        return redirect()->back()->with('success', 'Comment updated');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->back()->with('success', 'Comment removed');
    }
}
