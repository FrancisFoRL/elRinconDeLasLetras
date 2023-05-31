<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AddOpinion extends Component
{
    public $opinion;
    public $rating;

    public function render()
    {
        return view('livewire.add-opinion');
    }

    public function selectRating($value)
    {
        $this->rating = $value;
    }

    public function guardar()
    {

    }
}
