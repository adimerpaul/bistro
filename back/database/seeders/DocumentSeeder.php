<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table("documents")->insert([
            [ "codigoClasificador"=> "1","descripcion"=> "CI - CÉDULA DE IDENTIDAD","codigoPuntoVenta"=>0,"codigoSucursal"=>0],
            [ "codigoClasificador"=> "2","descripcion"=> "CEX - CÉDULA DE IDENTIDAD DE EXTRANJERO","codigoPuntoVenta"=>0,"codigoSucursal"=>0],
            [ "codigoClasificador"=> "3","descripcion"=> "PAS - PASAPORTE","codigoPuntoVenta"=>0,"codigoSucursal"=>0],
            [ "codigoClasificador"=> "4","descripcion"=> "OD - OTRO DOCUMENTO DE IDENTIDAD","codigoPuntoVenta"=>0,"codigoSucursal"=>0],
            [ "codigoClasificador"=> "5","descripcion"=> "NIT - NÚMERO DE IDENTIFICACIÓN TRIBUTARIA","codigoPuntoVenta"=>0,"codigoSucursal"=>0],

        ]);
    }
}
