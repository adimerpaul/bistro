<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CuiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //    
        DB::table("cuis")->insert([
            ["codigo"=>"AD8087E1","fechaVigencia"=>"2024-02-20 18:43:27",	"fechaCreacion"=>"2023-02-20 18:43:27",	"codigoPuntoVenta"=>0,	"codigoSucursal"=>0	],
            ["codigo"=>"1D464E1F","fechaVigencia"=>"2024-02-20 18:43:27",	"fechaCreacion"=>"2023-02-20 18:43:27",	"codigoPuntoVenta"=>1,	"codigoSucursal"=>0	],
        ]);
    }
}
