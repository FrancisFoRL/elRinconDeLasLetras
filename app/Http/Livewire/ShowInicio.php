<?php

namespace App\Http\Livewire;

use App\Models\Book;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Cache;

class ShowInicio extends Component
{
    public function render()
    {
        if (Auth::user()) {
            Cart::restore(auth()->user()->id);
        }
        $cartItemCount = Cart::count();
        $books = Book::inRandomOrder()->take(12)->get();
        return view('livewire.show-inicio', compact('books'));
    }

    public function store($book)
    {
        Cart::instance('default')->add([
            'id' => $book['id'],
            'name' => $book['title'],
            'price' => $book['price'],
            'qty' => 1,
            'options' => [
                'image' => $book['image'],
            ]
        ])->associate('App\Models\Book');


        if (Auth::user()) {
            Cart::store(auth()->user()->id);
        }

        session()->flash('success_message', 'Producto añadido al carrito');

        return redirect()->route('cart');
    }

    public function addToWishlist(Book $book)
    {
        Wishlist::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
        ]);

        session()->flash('success', 'Libro añadido de la lista de deseos');
    }
}
