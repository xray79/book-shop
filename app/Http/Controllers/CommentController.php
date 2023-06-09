<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Helpers\Helpers;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store()
    {
        // validate attributes and add user id
        $attributes = request()->validate([
            'book_id' => 'required',
            'text' => 'required',
        ]);
        $attributes['user_id'] = auth()->user()->id;

        Comment::create($attributes);
        return back()->with('success', 'Comment posted');
    }
}
