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
        $books = Book::get()->where('user_id', Auth::user()->id);

        return view('session.books.index', [
            'books' => $books,
        ]);
    }

    public function edit(Book $book)
    {
        $categories = Category::all();

        return view('session.books.edit', [
            'book' => $book,
            'categories' => $categories,
        ]);
    }

    public function update(Book $book)
    {
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
        $book->update($attributes);

        session()->flash('success', 'Book updated');
        return redirect()->back();
    }

    public function destroy(Book $book)
    {
        $book->delete();

        session()->flash('success', 'Book removed');
        return redirect()->back();
    }
}
