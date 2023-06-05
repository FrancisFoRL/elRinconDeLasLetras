<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Ejecuta la tarea de crear 50 instancias de la clase Customer utilizando el factory.
     *
     * @return void
     */
    public function run(): void
    {
        Customer::factory(50)->create();
    }
}
