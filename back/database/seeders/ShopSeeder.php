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
            ['avatar' => 'logo.png','nombre' => 'SABOR PERU','sucursal' => 'BistroFood SRL','color' => '#000000',],
            ['avatar' => 'logo2.png','nombre' => 'CAFE ITALIA','sucursal' => 'Casa Matriz','color' => '#000000',],
            ['avatar' => 'logo3.png','nombre' => 'VACA FRIA','sucursal' => 'Sucursal 2','color' => '#000000',],
        ]);
    }
}
