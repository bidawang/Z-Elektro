<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Katalog;

class KatalogSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 55; $i++) {
            Katalog::create([
                'nama' => 'Produk Dummy ' . $i,
                'harga_modal' => rand(5000, 50000),
                'harga_dalam' => rand(30000, 150000),
                'harga_luar'  => rand(60000, 250000),
                'foto' => null, // sengaja null biar ngetes inisial
            ]);
        }
    }
}
