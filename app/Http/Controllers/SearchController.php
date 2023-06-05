<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Realiza una búsqueda de libros por título.
     *
     * @param Request $request solicitud HTTP que contiene el título de búsqueda.
     * @return view vista con los resultados de la búsqueda.
     */
    public function search(Request $request)
    {
        $titulo = $request->input('titulo'); //Se obtiene el valor intoduccido en el campo de busqueda
        if (empty($titulo)) {
            // Si el campo de titulo está vacío, redirige al usuario a la página anterior
            return redirect()->back();
        }else{
            $books = Book::where('title', 'like', '%'.$titulo.'%')->orderBy('title', 'asc')->paginate(12); // Realiza la búsqueda de libros por título y se ordena por titulo ascendentemente y se pagina de 12 en 12
            $total = count(Book::where('title', 'like', '%'.$titulo.'%')->get()); // Obtiene el total de resultados de la búsqueda
            return view('search', compact('books', 'total'));
        }
    }
}
