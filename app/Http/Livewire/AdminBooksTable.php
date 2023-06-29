<?php

namespace App\Http\Livewire;

use App\Models\Book;
use App\Models\User;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class AdminBooksTable extends Component
{
    use WithPagination;

    public $sortField;
    public $search;

    public function render()
    {
        return view('livewire.admin-books-table', [
            'books' => Book::latest()
                ->where('title', 'like', "%{$this->search}%")
                ->orWhere('description', 'like', "%{$this->search}%")
                ->when($this->sortField, function ($query) {
                    $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
                })
                ->simplePaginate(10),
            'users' => User::all(),
            'categories' => Category::all(),
        ]);
    }
}
