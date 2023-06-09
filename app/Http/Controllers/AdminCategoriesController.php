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

        return view('admin.category.index', [
            'categories' => $categories->simplePaginate(10)
        ]);
    }

    public function store()
    {
        // endpoint for new category form
        // no create method, small form shown on index page
        $attributes = request()->validate([
            'category' => 'required'
        ]);

        Category::create(['name' => $attributes['category']]);

        // show the flash message and return back to index page
        return back()->with('success', 'Category created');
    }

    public function edit(Category $category)
    {
        // show edit page
        return view('admin.category.edit', [
            'category' => $category
        ]);
    }

    public function update(Category $category)
    {
        // endpoint for category update form
        $attributes = request()->validate([
            'category' => 'required',
        ]);

        $category->update([
            'name' => $attributes['category'],
        ]);

        return back()->with('success', 'Category updated');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return back()->with('success', 'Category deleted');
    }
}
