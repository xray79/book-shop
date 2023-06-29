<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Test extends Component
{
    public $searchResults;

    // protected $listeners = [
    //     'searchChange' => 'searchHandler',
    // ];

    // public function searchHandler(String $search): void
    // {
    //     $this->search = $search;
    // }

    public function render()
    {
        return view('livewire.test');
    }
}
