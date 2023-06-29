<?php

namespace App\Http\Livewire;

use App\Models\Book;
use App\Models\User;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;

class AdminEditBook extends Component
{
    use WithFileUploads;

    // accept book, users, categories, passed in from controller
    public Book $book;
    public $users;
    public $categories;

    // seperate book attributes
    public $title;
    public $description;
    public $thumbnail;

    // dropdown elements from book attributes
    public int $selectedUserId;
    public int $selectedCategoryId;

    // validation rules
    protected $rules = [
        'title' => 'required|min:5',
        'selectedUserId' => 'required',
        'selectedCategoryId' => 'required',
        'description' => 'required|min:5',
        'thumbnail' => 'required',
    ];

    public function submitHandler()
    {
        // validate inputs
        $this->validate();

        // default thumbnail from db = string, user uploaded thumbnail = class
        // if string, no need to store thumbnail
        if (!is_string($this->thumbnail)) {
            $this->thumbnail = $this->thumbnail->store('thumbnails');
        }

        // create update array with all attributes
        $attributes = [
            'title' => $this->title,
            'user_id' => $this->selectedUserId,
            'category_id' => $this->selectedCategoryId,
            'description' => $this->description,
            'thumbnail' => $this->thumbnail,
        ];

        // update book
        $this->book->update($attributes);

        $this->emitToggleEditFormEvent();
    }

    public function emitToggleEditFormEvent()
    {
        $this->emit('toggleEditForm');
    }

    // populate attributes on component mount
    public function mount()
    {
        $this->title = $this->book->title;
        $this->selectedUserId = $this->book->user->id;
        $this->selectedCategoryId = $this->book->category->id;
        $this->description = $this->book->description;
        $this->thumbnail = $this->book->thumbnail;

        $this->users = User::all();
        $this->categories = Category::all();
    }

    // real time validation
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.admin-edit-book');
    }
}
