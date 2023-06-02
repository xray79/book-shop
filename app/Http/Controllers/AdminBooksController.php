<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Helpers\Helpers;
use App\Models\Category;
use App\Models\User;

class AdminBooksController extends Controller
{
    public function index()
    {
        $books = Book::latest();

        return view('admin.book.index', ['books' => $books->simplePaginate(10)]);
    }

    public function create()
    {
        $books = Book::all();
        $users = User::all();
        $categories = Category::all();

        return view('admin.book.create', [
            'books' => $books,
            'users' => $users,
            'categories' => $categories,
        ]);
    }

    public function store()
    {
        $attributes = request()->validate([
            'user_id' => 'required',
            'category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'thumbnail' => 'required',
            'pdf' => 'required',
        ]);
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        $attributes['pdf'] = request()->file('pdf')->store('books');

        Book::create($attributes);

        session()->flash('success', 'Book uploaded');
        return redirect()->back();
    }

    public function edit(Book $book)
    {
        $users = User::all();
        $categories = Category::all();

        return view('admin.book.edit', [
            'book' => $book,
            'users' => $users,
            'categories' => $categories,
        ]);
    }

    public function update(Book $book)
    {
        $attributes = request()->validate([
            'title' => 'required',
            'user_id' => 'required',
            'category_id' => 'required',
            'thumbnail' => '',
            'description' => 'required',
        ]);

        // if the request contains a file labelled 'thumbnail', store it in thumbnails folder
        // otherwise use the book->thumbnail property
        $attributes['thumbnail'] = request()->file('thumbnail')?->store('thumbnails') ?? $book->thumbnail;
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

    protected function _updateBook($book)
    {
        // validate inputs and update book
        $attributes = request()->validate([
            'title' => 'required|min:5|max:255',
            'description' => 'required|min:10|max:255',
            'user_id' => 'required'
        ]);

        $book->update($attributes);
    }

    protected function _updateUser($user)
    {
        // validate inputs and update author
        // this does not update the author of the book, it changes the name of the user,
        // therefore changing the name of all books associated with this user

        $author = request()->validate([
            'author' => 'required',
        ]);
        $user->update(['name' => $author['author']]);
    }
}
