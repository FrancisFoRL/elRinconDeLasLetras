<?php

namespace App\Http\Livewire;

use App\Models\Book;
use App\Models\Wishlist as ModelsWishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Wishlist extends Component
{
    public $wishlist;

    public function mount()
    {
        $this->wishlist = auth()->user()->wishlist;
    }


    public function removeFromWishlist($id)
    {
        // Busca la lista de deseos con el ID proporcionado
        $wishlist = ModelsWishlist::findOrFail($id);

        // Elimina la lista de deseos
        $wishlist->delete();

        // Muestra un mensaje de éxito
        session()->flash('delete', 'El libro ha sido eliminado de tu lista de deseos');

        return redirect(url()->previous());

        // Actualiza la lista de deseos del usuario
        // $this->wishlist = auth()->user()->wishlist;



    }

    public function render()
    {
        return view('livewire.wishlist');
    }
}
