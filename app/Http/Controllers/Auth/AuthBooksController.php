<?php

namespace App\Http\Controllers\Auth;

use App\Models\Book;
use App\Helpers\Helpers;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthBooksController extends Controller
{
    public function index()
    {
        // show all books for the logged in user
        return view('session.books.index', [
            'books' => Book::get()->where('user_id', Auth::user()->id),
        ]);
    }

    public function edit(Book $book)
    {
        // edit one of the currently logged in user's books
        // all categories needed for dropdown select menu

        return view('session.books.edit', [
            'book' => $book,
            'categories' => Category::all(),
        ]);
    }

    public function update(Book $book)
    {
        // validation
        $attributes = request()->validate([
            'book-title' => 'required',
            'category_id' => 'required',
            'thumbnail' => 'sometimes|required|image',
            'description' => 'required',
        ]);

        // change 'book-title' to 'title' to fit book model
        $attributes = Helpers::renameAttribute('book-title', 'title', $attributes);

        // if the request contains a file labelled 'thumbnail', store it in thumbnails folder
        // otherwise use the book->thumbnail property
        $attributes['thumbnail'] = request()->file('thumbnail')?->store('thumbnails') ?? $book->thumbnail;
        $attributes['user_id'] = Auth::user()->id;


        // update book with all attributes
        $book->update($attributes);
        return back()->with('success', 'Book updated');
    }

    public function destroy(Book $book)
    {
        // delete book and redirect with flash message
        $book->delete();

        return redirect()->back()->with('success', 'Book removed');
    }
}
