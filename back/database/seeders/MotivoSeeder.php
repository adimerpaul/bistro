<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MotivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table("motivos")->insert([
            [ "codigoClasificador"=> "1","descripcion"=> "FACTURA MAL EMITIDA","codigoPuntoVenta"=>0,"codigoSucursal"=>0],
            [ "codigoClasificador"=> "2","descripcion"=> "NOTA DE CREDITO-DEBITO MAL EMITIDA","codigoPuntoVenta"=>0,"codigoSucursal"=>0],
            [ "codigoClasificador"=> "3","descripcion"=> "DATOS DE EMISION INCORRECTOS","codigoPuntoVenta"=>0,"codigoSucursal"=>0],
            [ "codigoClasificador"=> "4","descripcion"=> "FACTURA O NOTA DE CREDITO-DEBITO DEVUELTA","codigoPuntoVenta"=>0,"codigoSucursal"=>0]
        ]);
    }
}
