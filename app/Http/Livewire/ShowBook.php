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

    public $slug; //Varible que contiene el slug del libro
    public $book; //Varible que guarde el objeto de Libro
    public $content;
    public $rating;

    /**
     * Inicializa el componente y asigna el slug del libro.
     *
     * @param string $slug slug del libro en cuestión.
     * @return void
     */
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

    /**
     * Agrega una opinión sobre un libro.
     *
     * @param Request $request solicitud HTTP que contiene los datos de la opinión.
     * @return Url la ruta de donde se venía
     */
    public function addOpinion(Request $request)
    {
        try {
            // Se valida el formulario de opinión
            $request->validate([
                'opinion' => ['required', 'string', 'min:3'],
                'ratings' => ['required', 'numeric', 'between:1,5'],
            ]);

            // Se usa el objeto Review para crear una nueva opinión en la base de datos
            Review::create([
                'user_id' => auth()->user()->id,
                'book_id' => $request->book_id,
                'comment' => $request->opinion,
                'rating' => $request->ratings,
            ]);

            // Se muestra un mensaje de éxito
            session()->flash('send-opinion', 'La opinión se añadió correctamente');
            // Se redirige a la página anterior
            return redirect(url()->previous());
        } catch (ValidationException $e) {
            // En caso de error de validación, se muestra un mensaje de error
            session()->flash('wishlist-error', 'La opinión no se añadió correctamente');
            return redirect(url()->previous());
        }
    }

    /**
     * Elimina la opinión sobre un libro
     *
     * @param int $id id de la opinión a eliminar.
     * @return Url la ruta de donde se venía
     */
    public function deleteOpinion($id)
    {
        // Se busca la opinión por su id.
        $review = Review::find($id);

        // Se elimina la opinión de la base de datos
        $review->delete();

        // Se muestra un mensaje de éxito
        session()->flash('delete', 'La opinión del libro se elimino correctamente');

        // Se redirige a la página anterior
        return redirect()->back();
    }
}
