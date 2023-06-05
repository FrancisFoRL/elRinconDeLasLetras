<?php

namespace App\Http\Livewire\Cart;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

class CartShowInicio extends Component
{
    public function render()
    {
        $subtotal = Cart::subtotal(); // Se obtiene el precio total de carrito
        $cartCount = Cart::count(); // Obtiene la cantidad de productos en el carrito de compras

        return view('cart.cart-show-inicio', compact('subtotal', 'cartCount'));
    }
}
