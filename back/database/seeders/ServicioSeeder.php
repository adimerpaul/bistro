<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table("servicios")->insert([
            [ "codigoActividad"=> "561120","codigoProducto"=> "21391","descripcionProducto"=> "PLATOS PREPARADOS Y COMIDAS A BASE DE VERDURAS, LEGUMBRES Y PAPAS","codigoPuntoVenta"=>0,"codigoSucursal"=>0],
            [ "codigoActividad"=> "561120","codigoProducto"=> "63320","descripcionProducto"=> "SERVICIOS DE SUMINISTRO DE COMIDA EN ESTABLECIMIENTOS DE SERVICIO LIMITADO","codigoPuntoVenta"=>0,"codigoSucursal"=>0],
            [ "codigoActividad"=> "561120","codigoProducto"=> "99100","descripcionProducto"=> "OTROS PRODUCTOS O SERVICIOS ALCANZADOS POR EL IVA","codigoPuntoVenta"=>0,"codigoSucursal"=>0],
            [ "codigoActividad"=> "561120","codigoProducto"=> "213919","descripcionProducto"=> "PLATOS PREPARADOS Y COMIDAS A BASE DE VERDURAS, LEGUMBRES Y PAPAS IMPORTADO","codigoPuntoVenta"=>0,"codigoSucursal"=>0],
            [ "codigoActividad"=> "561120","codigoProducto"=> "633209","descripcionProducto"=> "SERVICIOS DE SUMINISTRO DE COMIDA EN ESTABLECIMIENTOS DE SERVICIO LIMITADO IMPORTADO","codigoPuntoVenta"=>0,"codigoSucursal"=>0],
            [ "codigoActividad"=> "561120","codigoProducto"=> "991009","descripcionProducto"=> "OTROS PRODUCTOS O SERVICIOS ALCANZADOS POR EL IVA IMPORTADO","codigoPuntoVenta"=>0,"codigoSucursal"=>0],
        ]);
    }
}
