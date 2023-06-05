<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Editorial;

class EditorialSeeder extends Seeder
{
    /**
     * Ejecuta la tarea de crear 40 instancias de la clase Editorial utilizando el factory.
     *
     * @return void
     */
    public function run()
    {
        Editorial::factory(40)->create();
    }
}
