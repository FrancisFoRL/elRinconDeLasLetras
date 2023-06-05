<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Muestra la página de categoría.
     *
     * @param string $slug contiene el slug de la categoria.
     * @return view vista de la página de la categoria.
     */
    public function index($slug)
    {
        $category = Category::where('slug', $slug)->first(); // Obtiene la categoría asociada al slug proporcionado
        $books = $category->books; // Obtiene los libros asociados a la categoría correspondiente

        return view('category.category', compact('books', 'category'));
    }
}
