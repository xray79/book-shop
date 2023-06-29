<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        // homepage
        $books = Book::latest();

        // modify/filter $books based on search param
        if (request('search')) {
            $books = $this->search($books);
        }

        return view('book.index', [
            'books' => $books->simplePaginate(10),
            'categories' => Category::all(),
            'usersJson' => json_encode(User::all()),
        ]);
    }

    private function search($books)
    {
        // return only the books where the title is like the request, with anything on either side
        // or where, (same for description)

        return $books->where('title', 'like', '%' . request('search') . '%')
            ->orWhere('description', 'like', '%' . request('search') . '%');
    }

    public function show(Book $book)
    {
        // show one book
        return view('book.show', [
            'book' => $book,
        ]);
    }

    public function create()
    {
        // show view to upload new books
        return view('book.create', [
            'categories' => Category::all(),
        ]);
    }

    public function store()
    {
        // POST endpoint for storing Books
        $attributes = request()->validate([
            'title' => 'required|min:5',
            'description' => 'required',
            'category_id' => 'required',
            'thumbnail' => 'sometimes|required|image',
            'pdf' => 'sometimes|required|mimes:pdf,epub,mobi',
        ]);

        // add missing attributes
        // thumbnaiil and pdf use storage uri
        $attributes['user_id'] = auth()->user()->id;

        // testing using default files
        $attributes['thumbnail'] = request()->file('thumbnail')?->store('thumbnails') ?? '/thumbnails/c4MegLxeF1MqS6Euk32XC5zmcx8cTysiaoGhVfik.png';
        $attributes['pdf'] = request()->file('pdf')?->store('books') ?? '/books/TQOpuY7h5hVv1I5lGyNV3qxy9qgQWAJUSQTxnQpr.epub';

        Book::create($attributes);
        return redirect('/')->with('success', 'Your book has been uploaded');
    }

    public function download(Book $book)
    {
        // sending a get req to books/download/{id} will let users download the book
        return response()->download(public_path('storage/' . $book->pdf));
    }
}
