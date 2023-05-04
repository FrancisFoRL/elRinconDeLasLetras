<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class BooksCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = Book::pluck('id'); //Traemos las ids de la tabla de Book
        $categories = Category::pluck('id');; //Traemos las ids de la tabla de Category

        /*
            Primero hacemos este foreach con los libros, para asi asegurarnos de que todos los
            libros minimo tienen una categoria.
        */
        foreach ($books as $book) {
            $category = $categories->random();
            DB::table('books_categories')->insert([
                'book_id' => $book,
                'category_id' => $category,
            ]);
        }

        /*
            Con este bucle lo que se hace es añadir unas categorias mas de forma aleatoria a algunos
            libros.
        */
        for ($i = 0; $i < 250; $i++) {
            $book = $books->random(); //Se elige un libro de forma aleatoria.
            $existingCategories = $book->categories->pluck('id')->toArray(); //Traemos las categorias ya asignadas al libro para no repetirlas

            do {
                $category = $categories->random(); //Se elige un libro de forma aleatoria.
            } while (in_array($category->id, $existingCategories) || $category->name === 'Sin categoria'); // Se comprueba si la categoría ya está asignada al libro actual

            DB::table('books_categories')->insert([
                'book_id' => $book,
                'category_id' => $category,
            ]);
        }
    }
}
