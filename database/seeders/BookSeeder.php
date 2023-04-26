<?php

namespace Database\Seeders;
use Illuminate\Support\Str;
use App\Models\Book;
use App\Models\Editorial;
use Illuminate\Database\Seeder;
use GuzzleHttp\Client;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Credenciales de la API de Open Library
        $client = new Client();

        // Credenciales de la API de Google Books
        $googleApiKey = 'AIzaSyCXitozlkM6Wnsxgk7qKR96VrY04ueNt1I';
        // Realizamos una búsqueda en la API de Open Library para obtener datos aleatorios de libros
        $response = $client->get('https://openlibrary.org/search.json?q=isbn:*&limit=20&distinct=true&language=spa');
        $books = json_decode($response->getBody(), true)['docs'];

        foreach ($books as $book) {
            // Buscamos el libro en Google Books para obtener la URL de la imagen de la portada, la descripción del libro y el numero de paginas
            $googleResponse = $client->get('https://www.googleapis.com/books/v1/volumes?q=' . urlencode($book['title']) . '&key=' . $googleApiKey);
            $googleData = json_decode($googleResponse->getBody(), true);

            $valido = false;
            $pages = 0;
            $isbn = '';
            $description = 'Sin descripción';

            for ($i = 0; $i < count($googleData['items']); $i++) {
                if (isset($googleData['items'][$i]['volumeInfo']['industryIdentifiers'][0]) && $googleData['items'][$i]['volumeInfo']['industryIdentifiers'][0]['type'] == 'ISBN_13') {
                        $isbn = $googleData['items'][$i]['volumeInfo']['industryIdentifiers'][0]['identifier'];
                        $valido = true;
                        break;

                } elseif (isset($googleData['items'][$i]['volumeInfo']['industryIdentifiers'][1]) && $googleData['items'][$i]['volumeInfo']['industryIdentifiers'][1]['type'] == 'ISBN_13') {
                        $isbn = $googleData['items'][$i]['volumeInfo']['industryIdentifiers'][1]['identifier'];
                        $valido = true;
                        break;
                }
            }

            for ($i = 0; $i < count($googleData['items']); $i++) {
                if (isset($googleData['items'][$i]['volumeInfo']['pageCount'])){
                    $pages = $googleData['items'][$i]['volumeInfo']['pageCount'];
                }
            }

            for ($i = 0; $i <= count($googleData['items']); $i++) {
                if (isset($googleData['items'][$i]['volumeInfo']['imageLinks'])) {
                    $image = $googleData['items'][$i]['volumeInfo']['imageLinks']['thumbnail'];
                    continue;
                }
            }


            // Asignamos la URL de la imagen de la portada, si esta se encuentra
            for ($i = 0; $i <= count($googleData['items']); $i++) {
                if (isset($googleData['items'][$i]['volumeInfo']['description'])) {
                    $description = $googleData['items'][$i]['volumeInfo']['description'];
                    continue;
                }
            }

            //Usar este cuando no supere limite de google
            //$isbn = $googleData['items'][0]['volumeInfo']['industryIdentifiers'][1] ?? $googleData['items'][0]['volumeInfo']['industryIdentifiers'][0];

            $title = $book['title'] ?? 'Sin título';
            $price = mt_rand(500, 7000) / 100; //$googleData['items'][0]['volumeInfo']['pageCount'] ?? 0; Asi seria con google

            /*
                Añadimos a la tabla el nuevo campo, pero antes de nada, con firstOrCreate, aseguramos que no exista otro libro con el mismo nombre,
                en el caso de que exista, no se añadira.
            */
            if(!$valido) continue;
            else{
                Book::firstOrCreate(
                    ['title' => $title],
                    [
                        'description' => $description,
                        'price' => $price,
                        'image' => $image,
                        'pages' => $pages,
                        'ISBN' => $isbn,
                        'slug' => Str::slug($title),
                        'stock' => rand(0, 200),
                        'editorial_id' => Editorial::all()->random()->id,
                        'author_id' => Editorial::all()->random()->id,
                    ]
                );
            }
        }
    }
}
