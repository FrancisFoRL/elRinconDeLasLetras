<?php

namespace App\Http\Livewire;

use App\Models\Book;
use Livewire\Component;

class ShowBook extends Component
{
    public $book;

    public function render()
    {
        return view('livewire.show-book');
    }
}
