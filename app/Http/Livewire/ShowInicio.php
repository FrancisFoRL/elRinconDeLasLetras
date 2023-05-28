<?php

namespace App\Http\Livewire;

use App\Models\Book;
use App\Models\Review;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ShowInicio extends Component
{
    public function render()
    {
        if (Auth::user()) {
            Cart::restore(auth()->user()->id);
        }

        $cartItemCount = Cart::count();
        $ratings = Review::select('book_id', DB::raw('avg(rating) as media'))
            ->groupBy('book_id')
            ->take(12)
            ->get();

        $sorted_ratings = $ratings->sort();

        $books = Book::whereIn('id', $sorted_ratings->pluck('book_id'))
            ->with('reviews')
            ->get();

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

        return redirect()->route('inicio');
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
