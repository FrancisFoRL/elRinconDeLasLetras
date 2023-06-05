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
        // Restaura el carrito de compras si el usuario está autenticado
        if (Auth::user()) {
            Cart::restore(auth()->user()->id);
        }

        // Obtiene la cantidad de elementos en el carrito
        $cartItemCount = Cart::count();
        $ratings = Review::select('book_id', DB::raw('avg(rating) as media'))
            ->groupBy('book_id')
            ->take(12)
            ->get();

        // Ordena las variaciones de menor a mayor
        $sorted_ratings = $ratings->sort();

        // Se obtiene los libros que tenemos en sorted_ratings
        $books = Book::whereIn('id', $sorted_ratings->pluck('book_id'))
            ->with('reviews')
            ->get();

        return view('livewire.show-inicio', compact('books'));
    }

    /**
     * Agrega los productos al carrito de la compra.
     *
     * @param array $book objeto de Book que va ser añadido al carrito.
     * @return Url la ruta de donde se venía
     */
    public function store($book)
    {
        //Creamos una nueva instancia de Cart y añadimos el nuevo producto al carrito.
        Cart::instance('default')->add([
            'id' => $book['id'],
            'name' => $book['title'],
            'price' => $book['price'],
            'qty' => 1,
            'options' => [
                'image' => $book['image'],
            ]
        ])->associate('App\Models\Book');

        //Si el usuario esta logueado, se guardara el carrito, para que no se pierda al desloguearse.
        if (Auth::user()) {
            Cart::store(auth()->user()->id);
        }

        // Se muestra un mensaje de éxito
        session()->flash('success_message', 'Producto añadido al carrito');

        //Se volvera a la ruta anterior
        return redirect()->route('inicio');
    }


    /**
     * Agrega los productos a la lista de deseo del usuario
     *
     * @param array $book objeto de Book que va ser añadido a la lista de deseos.
     * @return Url la ruta de donde se venía
     */
    public function addToWishlist(Book $book)
    {
        //Si el usuario esta logeado se añadira el libro a la lista de deseos. si no se llevara a la página de inicio de sesión
        if (Auth::user()) {
            // Busca la lista de deseos del usuario actual y crea un nuevo registro si no existe
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
                // El registro ya existía en la base de datos y se muestra el mensaje de que
                session()->flash('wishlist-error', 'El libro ya se encuentra en la lista de deseos');
                return redirect(url()->previous());
            }
        } else {
            return redirect()->route('login');
        }
    }
}
