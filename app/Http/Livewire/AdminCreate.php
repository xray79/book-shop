<?php

namespace App\Http\Livewire;

use App\Models\Book;
use App\Models\User;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;

class AdminCreate extends Component
{
    use WithFileUploads;

    public $selectedUserId;
    public $selectedCategoryId;

    public $title;
    public $description;

    public $thumbnail;
    public $pdf;

    protected $rules = [
        'title' => 'required|min:5',
        'selectedUserId' => 'required',
        'selectedCategoryId' => 'required',
        'description' => 'required|min:5',
        'thumbnail' => 'required',
        'pdf' => 'required'
    ];

    // handle form submit
    public function submitHandler()
    {
        // validate inputs
        $this->validate();

        $this->thumbnail = $this->thumbnail->store('thumbnails');
        $this->pdf = $this->pdf->store('books');

        // create update array with all attributes
        $attributes = [
            'title' => $this->title,
            'user_id' => $this->selectedUserId,
            'category_id' => $this->selectedCategoryId,
            'description' => $this->description,
            'thumbnail' => $this->thumbnail,
            'pdf' => $this->pdf,
        ];

        // create new book book
        Book::create($attributes);

        // hide form, show table
        $this->emitToggleCreateFormEvent();
    }

    public function emitToggleCreateFormEvent()
    {
        $this->emit('toggleCreateForm');
    }

    // lifecycle methods
    public function mount()
    {
        // set default values for user and category
        $this->selectedUserId = 1;
        $this->selectedCategoryId = 1;
    }

    public function updated($propertyName)
    {
        // lifecycle method to validate one property at a time
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.admin-create', [
            'users' => User::all(),
            'books' => Book::all(),
            'categories' => Category::all(),
        ]);
    }
}
