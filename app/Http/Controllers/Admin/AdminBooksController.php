<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\User;
use App\Helpers\Helpers;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminBooksController extends Controller
{
    public function index()
    {
        // show all books for admin table
        $books = Book::latest();

        if (request('search')) {
            $books = $this->_search($books);
        }

        return view('admin.book.index', [
            'books' => $books->simplePaginate(10)
        ]);
    }

    protected function _search($books)
    {
        return $books->where('title', 'like', '%' . request('search') . '%')
            ->orWhere('description', 'like', '%' . request('search') . '%');
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
            'thumbnail' => 'sometimes|image',
            'pdf' => 'sometimes|required|mimes:pdf,epub,mobi',
        ]);

        // file input fields should be replaced with file storage path
        $attributes['thumbnail'] = request()->file('thumbnail')?->store('thumbnails') ?? '/thumbnails/c4MegLxeF1MqS6Euk32XC5zmcx8cTysiaoGhVfik.png';
        $attributes['pdf'] = request()->file('pdf')?->store('books') ?? '/books/TQOpuY7h5hVv1I5lGyNV3qxy9qgQWAJUSQTxnQpr.epub';

        // create new book
        Book::create($attributes);

        return back()->with('success', 'Book uploaded');
    }

    public function edit(Book $book)
    {
        // route model binding creates $book variable

        // $book is associated with the {book:id} in the url
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
        // if left side is null, use right side
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
