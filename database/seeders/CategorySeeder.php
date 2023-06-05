<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Google\Client;
use Google\Service\Books;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Función encargada de crear todas la categorias. Esta categorias seran recibidas a partir de
     * usar la API de Google Books
     *
     * @return void
     */
    public function run(): void
    {
        $client = new Client(); // Se crea una nueva instancia del objeto Client Google.
        $client->setDeveloperKey('AIzaSyCXitozlkM6Wnsxgk7qKR96VrY04ueNt1I'); //Se introduce la clave necesaria para hacer conexion con la API de Google

        $service = new Books($client); // Se crea una nueva instancia del objeto Books, pasando el cliente $client como argumento.
        $optParams = array('maxResults' => 40); //Se define array, donde indicamos que queremos como máximo 40 resultados.
        $results = $service->volumes->listVolumes('subject', $optParams); //Se obtienen las listas que nos devuelve la API

        $categories = []; //Se crea un array para almacenar las categorías encontradas.
        $existingCategories = []; //Se crea un array para almacenar las categorías ya existentes.

        foreach ($results as $item) {
            $category = $item->getVolumeInfo()->getCategories()[0] ?? 'Sin categoría'; //Se obtiene la primera categoria del volumen que recibimos de la API, si no existe, sera 'Sin categoría'.
            //Se verifica si la categoría no existe en $existingCategories para evitar duplicados.
            if (!in_array($category, $existingCategories)) {
                $categories[] = $category;
                $existingCategories[] = $category;
            }
        }

        foreach ($categories as $category) {
             //Se añaden todos las categias que estan en cateogies a la base de datos
            Category::create(['name' => $category, 'slug' => Str::slug($category)]);
        }
    }
}
