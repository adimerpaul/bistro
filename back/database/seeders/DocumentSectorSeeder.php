<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentSectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table("document_sectors")->insert([

            [ "codigoClasificador"=> "1","descripcion"=> "FACTURA COMPRA-VENTA","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "2","descripcion"=> "FACTURA DE ALQUILER DE BIENES INMUEBLES","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "3","descripcion"=> "FACTURA COMERCIAL DE EXPORTACIÓN","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "4","descripcion"=> "FACTURA COMERCIAL DE EXPORTACIÓN EN LIBRE CONSIGNACIÓN","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "5","descripcion"=> "FACTURA DE ZONA FRANCA","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "6","descripcion"=> "FACTURA DE SERVICIO TURÍSTICO Y HOSPEDAJE","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "7","descripcion"=> "FACTURA DE COMERCIALIZACIÓN DE ALIMENTOS – SEGURIDAD","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "8","descripcion"=> "FACTURA DE TASA CERO POR VENTA DE LIBROS Y TRANSPORTE INTERNACIONAL DE CARGA","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "9","descripcion"=> "FACTURA DE COMPRA Y VENTA DE MONEDA EXTRANJERA","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "10","descripcion"=> "FACTURA DUTTY FREE","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "11","descripcion"=> "FACTURA SECTORES EDUCATIVOS","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "12","descripcion"=> "FACTURA DE COMERCIALIZACIÓN DE HIDROCARBUROS","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "13","descripcion"=> "FACTURA DE SERVICIOS BÁSICOS","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "14","descripcion"=> "FACTURA PRODUCTOS ALCANZADOS POR EL ICE","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "15","descripcion"=> "FACTURA DE ENTIDADES FINANCIERAS","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "16","descripcion"=> "FACTURA DE HOTELES","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "17","descripcion"=> "FACTURA DE HOSPITALES/CLÍNICAS","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "18","descripcion"=> "FACTURA DE JUEGOS DE AZAR","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "19","descripcion"=> "FACTURA HIDROCARBUROS ALCANZADA IEHD","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "20","descripcion"=> "FACTURA COMERCIAL DE EXPORTACIÓN DE MINERALES","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "21","descripcion"=> "FACTURA VENTA INTERNA MINERALES","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "22","descripcion"=> "FACTURA TELECOMUNICACIONES","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "23","descripcion"=> "FACTURA PREVALORADA","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "24","descripcion"=> "NOTA DE CRÉDITO-DÉBITO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "28","descripcion"=> "FACTURA COMERCIAL DE EXPORTACIÓN DE SERVICIOS","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "29","descripcion"=> "NOTA DE CONCILIACION","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "30","descripcion"=> "BOLETO AEREO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "31","descripcion"=> "FACTURA DE SUMINISTRO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "32","descripcion"=> "FACTURA ICE ZONA FRANCA","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "33","descripcion"=> "FACTURA TASA CERO BIENES CAPITAL","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "34","descripcion"=> "FACTURA DE SEGUROS","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "35","descripcion"=> "FACTURA COMPRA VENTA BONIFICACIONES","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "36","descripcion"=> "FACTURA PREVALORADA SDCF","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "37","descripcion"=> "FACTURA DE COMERCIALIZACIÓN DE GNV","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "38","descripcion"=> "FACTURA HIDROCARBUROS NO ALCANZADA IEHD","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "39","descripcion"=> "FACTURA COMERCIALIZACION GN y GLP","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "40","descripcion"=> "FACTURA DE SERVICIOS BÁSICOS ZF","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "41","descripcion"=> "FACTURA COMPRA VENTA TASAS","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "42","descripcion"=> "FACTURA ALQUILER ZF","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "43","descripcion"=> "FACTURA COMERCIAL DE EXPORTACIÓN HIDROCARBUROS","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "44","descripcion"=> "FACTURA IMPORTACION COMERCIALIZACION LUBRICANTES","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "45","descripcion"=> "FACTURA COMERCIAL DE EXPORTACION PRECIO VENTA","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "46","descripcion"=> "FACTURA SECTORES EDUCATIVO ZONA FRANCA","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "47","descripcion"=> "NOTA CREDITO DEBITO DESCUENTO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "48","descripcion"=> "NOTA CREDITO DEBITO ICE","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "49","descripcion"=> "FACTURA TELECOMUNICACIONES ZONA FRANCA","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "50","descripcion"=> "FACTURA HOSPITAL CLINICA ZONA FRANCA","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "51","descripcion"=> "FACTURA ENGARRAFADORAS","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            
        ]);
    }
}
