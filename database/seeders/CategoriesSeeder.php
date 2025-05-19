<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori')->insert([
            [
                'nama' => 'Komputer & Laptop',
            ],
            [
                'nama' => 'Printer & Scanner',
            ],
            [
                'nama' => 'Air Conditioner',
            ],
            [
                'nama' => 'Televisi & Video Wall',
            ],
            [
                'nama' => 'Kamera & Fotografi',
            ],
            [
                'nama' => 'Networking ',
            ],
        ]);
    }
}
