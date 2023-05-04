<?php

namespace App\Http\Livewire;

use App\Models\Book;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class Navbar extends Component
{
    public $query;
    public $books;

    public function render()
    {
        $contenido = Cart::count();

        return view('livewire.navbar', compact('contenido'));
    }

    public function autocomplete(Request $request)
    {
        $data = Book::select("title")
            ->where('title', 'LIKE', '%' . $request->get('query') . '%')
            ->get();
        dd($data);
        return response()->json($data);
    }
}
