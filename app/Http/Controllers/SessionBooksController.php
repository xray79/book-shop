<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionBooksController extends Controller
{
    public function index()
    {
        // show all books for the logged in user
        $books = Book::get()->where('user_id', Auth::user()->id);

        return view('session.books.index', [
            'books' => $books,
        ]);
    }

    public function edit(Book $book)
    {
        // route model binding gets the relevant book
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
            'title' => 'required',
            'category_id' => 'required',
            'thumbnail' => '',
            'description' => 'required',
        ]);

        // if the request contains a file labelled 'thumbnail', store it in thumbnails folder
        // otherwise use the book->thumbnail property
        $attributes['thumbnail'] = request()->file('thumbnail')?->store('thumbnails') ?? $book->thumbnail;
        $attributes['user_id'] = Auth::user()->id;

        // update book with all attributes
        $book->update($attributes);

        return redirect()->back('success', 'Book updated');
    }

    public function destroy(Book $book)
    {
        // delete book and redirect with flash message
        $book->delete();

        return redirect()->back()->with('success', 'Book removed');
    }
}
