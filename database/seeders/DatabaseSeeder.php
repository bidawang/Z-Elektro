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
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'level' => 'admin',
        ]);
        User::factory()->create([
            'name' => 'Kasir User',
            'email' => 'kasir@example.com',
            'level' => 'kasir',
        ]);
    }
}
