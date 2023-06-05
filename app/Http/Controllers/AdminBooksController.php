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
        // show all books for admin table
        $books = Book::latest();

        return view('admin.book.index', ['books' => $books->simplePaginate(10)]);
    }

    public function create()
    {
        // show the form to create a new book with admin permissions
        // admins should be able to assign a book to any user

        return view('admin.book.create', [
            'books' => Book::all(),
            'users' => User::all(),
            'categories' => Category::all(),
        ]);
    }

    public function store()
    {
        // endpoint for creating a book with admin permissions

        // validate the POST req
        $attributes = request()->validate([
            'user_id' => 'required',
            'category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'thumbnail' => 'required',
            'pdf' => 'required',
        ]);

        // file input fields should be replaced with file storage path
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        $attributes['pdf'] = request()->file('pdf')->store('books');

        // create new book
        Book::create($attributes);

        return back()->with('success', 'Book uploaded');
    }

    public function edit(Book $book)
    {
        // route model binding creates $book variable

        // $book is associated with the id in the url
        // all users and categories are needed for admin permissions
        // admins should be able to assign a book to any user or category

        return view('admin.book.edit', [
            'book' => $book,
            'users' => User::all(),
            'categories' => Category::all(),
        ]);
    }

    public function update(Book $book)
    {
        // endpoint for edit form

        // form validation
        $attributes = request()->validate([
            'book-title' => 'required',
            'user_id' => 'required',
            'category_id' => 'required',
            'thumbnail' => '',
            'description' => 'required',
        ]);

        // format attributes for Book model
        $attributes = Helpers::renameAttribute('book-title', 'title', $attributes);

        // if the request contains a file labelled 'thumbnail', store it in thumbnails folder
        // otherwise use the book->thumbnail property
        $attributes['thumbnail'] = request()->file('thumbnail')?->store('thumbnails') ?? $book->thumbnail;
        $book->update($attributes);

        // show a flash message and return to the form page
        return back()->with('success', 'Book updated');
    }

    public function destroy(Book $book)
    {
        // delete book and show flash message
        $book->delete();

        return back()->with('success', 'Book removed');
    }
}
