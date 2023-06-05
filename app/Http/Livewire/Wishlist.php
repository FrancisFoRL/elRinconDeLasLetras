<?php

namespace App\Http\Livewire;

use App\Models\Book;
use App\Models\Wishlist as ModelsWishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Wishlist extends Component
{
    public $wishlist; //Lista de deseos del usuario.

    public function mount()
    {
        $this->wishlist = auth()->user()->wishlist;
    }

    /**
     * Elimina un libro de la lista de deseos.
     *
     * @param int $id ID del producto de la lista de desea eliminar.
     * @return Url la ruta de donde se venía
     */
    public function removeFromWishlist($id)
    {
        // Se busca el id del producto de la wishlist a eliminar
        $wishlist = ModelsWishlist::findOrFail($id);

        // Elimina el producto de la lista de deseos
        $wishlist->delete();

        // Se muestra un mensaje de éxito
        session()->flash('delete', 'El libro ha sido eliminado de tu lista de deseos');

        //Se volvera a la ruta anterior
        return redirect(url()->previous());
    }

    public function render()
    {
        return view('livewire.wishlist');
    }
}
