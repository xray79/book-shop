<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        // show one category, and all books associated with that category

        return view('category.show', [
            'books' => $category->book,
            'category' => $category
        ]);
    }

    private function search($books)
    {
        // return only the books where the title is like the request, with anything on either side
        // or where, (same for description)

        return $books->where('title', 'like', '%' . request('search') . '%')
            ->orWhere('description', 'like', '%' . request('search') . '%');
    }
}
