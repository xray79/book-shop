<?php

namespace App\Http\Livewire;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use App\Helpers\Enums;
use App\Helpers\Enums\AdminBooksState;
use Livewire\Component;
use Livewire\WithPagination;

class AdminBooks extends Component
{
    use WithPagination;

    public $search;
    public $sortField;
    public bool $sortAsc = true;

    protected $books;
    protected $users;
    protected $categories;

    public Book $editBook;
    public Book $deleteBook;

    public $successMessage = '';

    public $state = [
        'isEditFormVisible' => false,
        'isDeleteFormVisible' => false,
        'isNewBookFormVisible' => false,
        'isTableVisible' => true,
    ];

    protected $listeners = [
        'toggleEditForm' => 'toggleEditFormHandler',
        'toggleCreateForm' => 'toggleNewBookFormHandler',
        'toggleDeleteForm' => 'toggleDeleteFormHandler',
        'deleteBook' => 'deleteBookHandler',
    ];

    // state functions
    private function toggleStates(array $states): void
    {
        foreach ($states as $stateName)
            $this->state[$stateName] = !$this->state[$stateName];
    }

    private function setState(string $key): void
    {
        // set all values in array to false, in $this->state array
        // set only the specified key to true
        $this->state = array_map(
            fn ($val) => $val = false,
            $this->state
        );
        $this->state[$key] = true;
    }

    // event handlers
    public function toggleEditFormHandler(Book $book): void
    {
        // handles toggle edit form event
        // toggle visibility for the edit form
        // pass in the current book to be edited from foreach loop
        $this->editBook = $book;
        $this->toggleStates(['isTableVisible', 'isEditFormVisible']);
    }

    public function toggleDeleteFormHandler(Book $book): void
    {
        // handles toggle delete form event
        // toggle delete modal for current book in foreach loop
        $this->deleteBook = $book;
        $this->toggleStates(['isDeleteFormVisible']);
    }

    public function deleteBookHandler(Book $book): void
    {
        // handles deleteBook event fired from AdminDelete,
        // cannot be handled in component b/c it causes hydration error
        $book->delete();

        $this->successMessage = 'Book deleted';
    }

    public function toggleNewBookFormHandler(): void
    {
        // handles toggleNewBook event
        $this->toggleStates(['isTableVisible', 'isNewBookFormVisible']);
    }

    // sort and render
    public function updatingSearch()
    {
        // lifecycle method
        // when $search is updated, the pagination is reset to allow search on all pages
        $this->resetPage();
    }

    public function sortBy($field): void
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function mount()
    {
        $this->books = Book::latest()->get();
        $this->users = User::all();
        $this->categories = Category::all();
    }

    public function render()
    {
        return view('livewire.admin-books', [
            'books' => Book::latest()
                ->where('title', 'like', "%{$this->search}%")
                ->orWhere('description', 'like', "%{$this->search}%")
                ->when($this->sortField, function ($query) {
                    $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
                })
                ->simplePaginate(10),
            'users' => $this->users,
            'categories' => $this->categories,
            'search' => $this->search,
        ]);
    }
}
