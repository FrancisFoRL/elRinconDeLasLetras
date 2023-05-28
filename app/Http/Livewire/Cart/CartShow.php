<?php

namespace App\Http\Livewire\Cart;

use App\Models\Book;
use Livewire\Component;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class CartShow extends Component
{
    public function render()
    {
        $subtotal = Cart::subtotal();

        return view('cart.cart-show', compact('subtotal'));
    }

    public function aumentarCantidad($rowId)
    {
        $book = Cart::get($rowId);
        $quantity = $book->qty + 1;
        Cart::update($rowId, $quantity);
        if (Auth::user()) {
            Cart::store(auth()->user()->id);
        }else{
            Cart::store('');
        }
    }

    public function disminuirCantidad($rowId)
    {
        $book = Cart::get($rowId);
        $quantity = $book->qty - 1;
        Cart::update($rowId, $quantity);
        if (Auth::user()) {
            Cart::store(auth()->user()->id);
        }else{
            Cart::store('');
        }
    }

    public function eliminar($id)
    {
        Cart::remove($id);
        if (Auth::user()) {
            Cart::store(auth()->user()->id);
        }else{
            Cart::store('');
        }
        session()->flash('delete', 'Producto eliminado del carrito');
        return redirect(url()->previous());
    }

    public function clearCart()
    {
        Cart::destroy();
        if (Auth::user()) {
            Cart::store(auth()->user()->id);
        }else{
            Cart::store('');
        }
        session()->flash('delete', 'Carrito eliminado correctamente');
        return redirect(url()->previous());
    }
}
