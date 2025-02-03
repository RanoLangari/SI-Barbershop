<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'verified' => 1,
        ]);

        User::factory()->create([
            'name' => 'pelanggan',
            'email' => 'pelanggan@mail.com',
            'password' => bcrypt('password'),
            'role' => 'pelanggan',
            'verified' => 1,

        ]);

        User::factory()->create([
            'name' => 'barberman',
            'email' => 'barberman@mail.com',
            'password' => bcrypt('password'),
            'role' => 'barberman',
            'verified' => 1,
        ]);
    }
}
