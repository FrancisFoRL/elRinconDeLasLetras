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
        $subtotal = Cart::subtotal(); // Se obtiene el precio total de carrito

        return view('cart.cart-show', compact('subtotal'));
    }

    /**
     * Aumenta la cantidad de un libro en el carrito
     *
     * @param int $rowId id de la columna del carrito a cambiar la cantidad de un libro
     * @return void
     */
    public function aumentarCantidad($rowId)
    {
        $book = Cart::get($rowId); // Obtiene el libro correspondiente al id de fila proporcionado
        $quantity = $book->qty + 1; // Aumenta la cantidad del libro en 1
        Cart::update($rowId, $quantity); // Se actualiza la cantidad del libro en el carrito
        // Se almacena el carrito si el usuario esta logueado
        if (Auth::user()) {
            Cart::store(auth()->user()->id);
        } else {
            Cart::store('');
        }
    }

    /**
     * Disminuye la cantidad de un libro en el carrito
     *
     * @param int $rowId id de la columna del carrito a cambiar la cantidad de un libro
     * @return void
     */
    public function disminuirCantidad($rowId)
    {
        $book = Cart::get($rowId); // Obtiene el libro correspondiente al id de fila proporcionado
        $quantity = $book->qty - 1; // Disminuye la cantidad del libro en 1
        Cart::update($rowId, $quantity); // Se actualiza la cantidad del libro en el carrito
        // Se almacena el carrito si el usuario esta logueado
        if (Auth::user()) {
            Cart::store(auth()->user()->id);
        } else {
            Cart::store('');
        }
    }


    /**
     * Elimina el libro del carrito de la compra
     *
     * @param int $id id del producto del carrito que va ser eliminaod del carrito
     * @return void
     */
    public function eliminar($id)
    {
        Cart::remove($id); // Se elimina el producto del carrito de la compra
        // Se almacena el carrito si el usuario esta logueado
        if (Auth::user()) {
            Cart::store(auth()->user()->id);
        } else {
            Cart::store('');
        }
        // Se muestra un mensaje de éxito
        session()->flash('delete', 'Producto eliminado del carrito');
        //Se volvera a la ruta anterior
        return redirect(url()->previous());
    }

    /**
     * Elimina todo los productos que se encuentren en el carrito de compras.
     *
     * @return void
     */
    public function clearCart()
    {
        Cart::destroy(); //Vacía el carrito de compras

        // Se almacena el carrito si el usuario esta logueado
        if (Auth::user()) {
            Cart::store(auth()->user()->id);
        } else {
            Cart::store('');
        }

        // Se muestra un mensaje de éxito
        session()->flash('delete', 'Carrito eliminado correctamente');

        //Se volvera a la ruta anterior
        return redirect(url()->previous());
    }
}
