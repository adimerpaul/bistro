<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table("events")->insert([
            [ "codigoClasificador"=> "1","descripcion"=> "CORTE DEL SERVICIO DE INTERNET","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "2","descripcion"=> "INACCESIBILIDAD AL SERVICIO WEB DE LA ADMINISTRACIÓN TRIBUTARIA","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "3","descripcion"=> "INGRESO A ZONAS SIN INTERNET POR DESPLIEGUE DE PUNTO DE VENTA EN VEHICULOS AUTOMOTORES","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "4","descripcion"=> "VENTA EN LUGARES SIN INTERNET","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "5","descripcion"=> "VIRUS INFORMÁTICO O FALLA DE SOFTWARE","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "6","descripcion"=> "CAMBIO DE INFRAESTRUCTURA DEL SISTEMA INFORMÁTICO DE FACTURACIÓN O FALLA DE HARDWARE","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "7","descripcion"=> "CORTE DE SUMINISTRO DE ENERGIA ELECTRICA","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],

        ]);
    }
}
