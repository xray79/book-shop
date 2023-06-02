<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::latest();

        return view('admin.category.index', ['categories' => $categories->paginate(10)]);
    }

    public function store()
    {
        Category::create(['name' => request('category')]);
        session()->flash('success', 'Category created');

        return redirect()->back();
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

        session()->flash('success', 'Category updated');
        return back();
    }

    public function destroy(Category $category)
    {
        $category->delete();

        session()->flash('success', 'Category deleted');
        return back();
    }
}
