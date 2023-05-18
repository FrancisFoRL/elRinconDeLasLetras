<?php

namespace App\Http\Livewire\Cart;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

class CartShowInicio extends Component
{
    public function render()
    {
        $subtotal = Cart::subtotal();
        $cartCount = Cart::count();

        return view('cart.cart-show-inicio', compact('subtotal', 'cartCount'));
    }
}
