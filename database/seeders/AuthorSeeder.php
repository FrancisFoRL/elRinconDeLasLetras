<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Ejecuta la tarea de crear 60 instancias de la clase Author utilizando factory.
     *
     * @return void
     */
    public function run(): void
    {
        Author::factory(60)->create();
    }
}
