<?php

namespace App\Http\Livewire;

use App\Models\Book;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Livewire\WithFileUploads;

class ShowBook extends Component
{
    use WithFileUploads;

    public $slug;
    public $book;
    public $content;
    public $rating;

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

        return redirect(url()->previous());
    }

    public function addToWishlist(Book $book)
    {
        if (Auth::user()) {
            $wishlist = Wishlist::firstOrCreate([
                'user_id' => auth()->id(),
                'book_id' => $book->id,
            ]);

            if ($wishlist->wasRecentlyCreated) {
                // El registro fue creado recientemente
                // Es decir, no existía previamente en la base de datos
                session()->flash('wishlist', 'Libro añadido a la lista de deseos');
                return redirect(url()->previous());
            } else {
                // El registro ya existía en la base de datos
                session()->flash('wishlist-error', 'El libro ya se encuentra en la lista de deseos');
                return redirect(url()->previous());
            }
        } else {
            return redirect()->route('login');
        }
    }
}
