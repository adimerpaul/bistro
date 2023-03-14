<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table("activities")->insert([
            [ "codigoCaeb"=> "561120","descripcion"=> "EXPENDIO DE COMIDAS EN CAFETERÍAS, CONFITERÍAS, SNACK, HELADERÍAS Y OTROS LOCALES DE COMIDA RÁPIDA","tipoActividad"=>"P","codigoPuntoVenta"=>0,"codigoSucursal"=>0],
        ]);
    }
}
