<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        // show all books associated with one category

        return view('category.show', [
            'books' => $category->book,
            'category' => $category
        ]);
    }
}
