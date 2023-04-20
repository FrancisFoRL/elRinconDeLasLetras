<?php

namespace App\Http\Livewire\Cart;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartShowInicio extends Component
{
    public function render()
    {
        $subtotal = Cart::subtotal();
        $cartCount = Cart::count();

        return view('cart.cart-show-inicio', [
            'subtotal' => $subtotal,
            'count' => $cartCount,
        ]);
    }

    public function aumentarCantidad($rowId)
    {
        $book = Cart::get($rowId);
        $quantity = $book->qty + 1;
        Cart::update($rowId, $quantity);
    }

    public function disminuirCantidad($rowId)
    {
        $book = Cart::get($rowId);
        $quantity = $book->qty - 1;
        Cart::update($rowId, $quantity);
    }

    public function eliminar($id)
    {
        Cart::remove($id);
        $this->emit('info', 'Producto eliminado');
        session()->flash('success_message', 'Producto eliminado');
    }
}
