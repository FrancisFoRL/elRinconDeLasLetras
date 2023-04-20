<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\BookSeeder as SeedersBookSeeder;
use Illuminate\Database\Seeder;
use Google\Client;
use Google\Service\Books;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(CategorySeeder::class);
        $this->call(EditorialSeeder::class);
        $this->call(AuthorSeeder::class);
        $this->call(BookSeeder::class);
        // $this->call(UserSeeder::class);
        $this->call(BooksCategoriesSeeder::class);
        $this->call(CustomerSeeder::class);
    }
}
