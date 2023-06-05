<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Ejecuta la tarea de crear 200 instancias de la clase Review utilizando factory.
     *
     * @return void
     */
    public function run()
    {
        Review::factory(200)->create();
    }
}
