<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            'Roti',
            'Pastry',
            'Donat',
            'Kue',
            'Cookies',
        ];

        foreach ($kategoris as $nama) {
            Kategori::firstOrCreate([
                'nama_kategori' => $nama
            ]);
        }
    }
}
