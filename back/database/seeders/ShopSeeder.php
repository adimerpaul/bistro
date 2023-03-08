<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('shops')->insert([
            'avatar' => 'logo.png',
            'nombre' => 'Tienda 1',
            'sucursal' => 'Sucursal 1',
            'color' => '#000000',
        ]);
    }
}
