<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $titulo = $request->input('titulo');
        if (empty($titulo)) {
            // Si el campo de entrada está vacío, redirige al usuario a la página anterior
            return redirect()->back();
        }else{
            $books = Book::where('title', 'like', '%'.$titulo.'%')->paginate(12);
            $total = count(Book::where('title', 'like', '%'.$titulo.'%')->get());
            return view('search', compact('books', 'total'));
        }
    }
}
