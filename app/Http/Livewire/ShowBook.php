<?php

namespace App\Http\Livewire;

use App\Models\Book;
use App\Models\Review;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
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

    public function addOpinion(Request $request)
    {
        try {
            $request->validate([
                'opinion' => ['required', 'string', 'min:3'],
                'ratings' => ['required', 'numeric', 'between:1,5'],
            ]);

            Review::create([
                'user_id' => auth()->user()->id,
                'book_id' => $request->book_id,
                'comment' => $request->opinion,
                'rating' => $request->ratings,
            ]);
            session()->flash('send-opinion', 'La opinión se añadió correctamente');
            return redirect(url()->previous());
        } catch (ValidationException $e) {
            session()->flash('wishlist-error', 'La opinión no se añadió correctamente');
            return redirect(url()->previous());
        }
    }

    public function deleteOpinion($id){
        $review = Review::find($id);
        $review->delete();
        session()->flash('delete', 'La opinión del libro se elimino correctamente');
        return redirect()->back();
    }
}
