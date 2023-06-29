<?php

namespace App\Http\Livewire;

use App\Models\Book;
use Livewire\Component;

class AdminDelete extends Component
{
    public $book;

    public function emitDeleteBookEvent()
    {
        $this->emit('deleteBook', $this->book);
        $this->emitToggleDeleteFormEvent();
    }

    public function emitToggleDeleteFormEvent()
    {
        $this->emit('toggleDeleteForm');
    }

    public function render()
    {
        return view('livewire.admin-delete');
    }
}
