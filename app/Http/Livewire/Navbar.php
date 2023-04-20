<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class Navbar extends Component
{
    public function render()
    {
        $contenido = Cart::count();

        return view('livewire.navbar', compact('contenido'));
    }
}
