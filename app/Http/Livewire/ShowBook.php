<?php

namespace App\Http\Livewire;

use App\Models\Book;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowBook extends Component
{
    public $slug;
    public $book;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->book = Book::where('slug', $this->slug)->first();
    }

    public function render()
    {
        return view('livewire.show-book', [
            'book' => $this->book,
        ]);
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
        if (Auth::user()) {
            Wishlist::firstOrCreate([
                'user_id' => auth()->id(),
                'book_id' => $book->id,
            ]);
            session()->flash('success', 'Libro añadido de la lista de deseos');
        } else {
            return redirect()->route('login');
        }
    }
}
