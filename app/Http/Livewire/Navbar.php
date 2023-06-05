<?php

namespace App\Http\Livewire;

use App\Models\Book;
use App\Models\Category;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class Navbar extends Component
{
    public $query; // Variable para almacenar la consulta de búsqueda ingresada por el usuario
    public $books; // Variable para almacenar los libros que coinciden con la búsqueda

    public function render()
    {
        $contenido = Cart::count(); // Devuelve la cantidad de elementos en el carrito
        $categorias = Category::all(); // Obtiene todas las categorías de libros

        return view('livewire.navbar', compact('contenido', 'categorias'));
    }
}
