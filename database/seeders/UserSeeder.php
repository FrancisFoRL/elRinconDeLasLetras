<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Francisco Castillo Brull',
            'email' => 'francis.cb12@gmail.com',
            'email_verified_at' => now(),
            'password' => password_hash('secret0', PASSWORD_DEFAULT), // password, recordar deshasehar para poder usarla eso seria con password_verify()
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
            'current_team_id' => null,
        ]);

        User::factory(50)->create();
    }
}
