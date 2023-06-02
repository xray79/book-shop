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
        $books = Book::latest();
        $categories = Category::all();
        $users = User::all();

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
        $num_users = User::all()->count();

        return view('book.show', [
            'book' => $book,
            'num_users' => $num_users,
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

        // create final array
        $attributes['user_id'] = auth()->user()->id;
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        $attributes['pdf'] = request()->file('pdf')->store('books');

        Book::create($attributes);

        session()->flash('success', 'Your book has been uploaded');
        return redirect('/');
    }

    public function download(Book $book)
    {
        // sending a get req to books/download/{id} will let users download the book
        $file = public_path('storage/' . $book->pdf);
        return response()->download($file);
    }
}
