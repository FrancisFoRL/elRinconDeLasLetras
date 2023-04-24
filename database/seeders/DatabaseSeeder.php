<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
        $this->call(ReviewSeeder::class);
    }
}
