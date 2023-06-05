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
        // need books to show all books
        // all categories and users for dropdowns
        $books = Book::latest();
        $categories = Category::all();
        $users = User::all();

        // modify/filter $books var only if there is a search param
        if (request('search')) {
            $books = $this->_search($books);
        }

        return view('book.index', [
            'books' => $books->simplePaginate(10),
            'categories' => $categories,
            'users' => $users,
        ]);
    }

    protected function _search($books)
    {
        // return only the books where the title is like the request, with anything on either side
        // or where, (same for description)

        return $books->where('title', 'like', '%' . request('search') . '%')
            ->orWhere('description', 'like', '%' . request('search') . '%');
    }

    public function show(Book $book)
    {
        return view('book.show', [
            'book' => $book,
        ]);
    }

    public function create()
    {
        // used for user book upload view
        $categories = Category::latest();
        return view('book.create', ['categories' => $categories->get()]);
    }

    public function store()
    {
        // POST endpoint for storing Books
        $attributes = request()->validate([
            'title' => 'required|min:5',
            'description' => 'required',
            'category_id' => 'required',
            'thumbnail' => 'required|image',
            'pdf' => 'required',
        ]);

        // create final array, update files to storage location
        $attributes['user_id'] = auth()->user()->id;
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        $attributes['pdf'] = request()->file('pdf')->store('books');

        Book::create($attributes);

        return redirect('/')->with('success', 'Your book has been uploaded');
    }

    public function download(Book $book)
    {
        // sending a get req to books/download/{id} will let users download the book

        return response()->download(public_path('storage/' . $book->pdf));
    }
}
