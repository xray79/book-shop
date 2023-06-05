<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoriesController extends Controller
{
    public function index()
    {
        // show all categories for admin categories table
        $categories = Category::latest();

        return view('admin.category.index', ['categories' => $categories->paginate(10)]);
    }

    public function store()
    {
        // endpoint for new category form
        // no create method, small form shown on index page
        Category::create(['name' => request('category')]);

        // show the flash message and return back to index page
        return back()->with('success', 'Category created');
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', [
            'category' => $category
        ]);
    }

    public function update(Category $category)
    {
        $attributes = request()->validate([
            'category' => 'required',
        ]);
        $name = $attributes['category'];

        $category->update([
            'name' => $name
        ]);

        return back()->with('success', 'Category updated');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return back()->with('success', 'Category deleted');
    }
}
