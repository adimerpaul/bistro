<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeyendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table("leyendas")->insert([
            [ "codigoActividad"=> "561120","descripcionLeyenda"=> "Ley N° 453: Tienes derecho a un trato equitativo sin discriminación en la oferta de servicios.","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoActividad"=> "561120","descripcionLeyenda"=> "Ley N° 453: En caso de incumplimiento a lo ofertado o convenido, el proveedor debe reparar o sustituir el servicio.","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoActividad"=> "561120","descripcionLeyenda"=> "Ley N° 453: El proveedor debe exhibir certificaciones de habilitación o documentos que acrediten las capacidades u ofertas de servicios especializados.","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoActividad"=> "561120","descripcionLeyenda"=> "Ley N° 453: Tienes derecho a recibir información sobre las características y contenidos de los servicios que utilices.","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoActividad"=> "561120","descripcionLeyenda"=> "Ley N° 453: El proveedor de servicios debe habilitar medios e instrumentos para efectuar consultas y reclamaciones.","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoActividad"=> "561120","descripcionLeyenda"=> "Ley N° 453: El proveedor deberá suministrar el servicio en las modalidades y términos ofertados o convenidos.","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoActividad"=> "561120","descripcionLeyenda"=> "Ley N° 453: La interrupción del servicio debe comunicarse con anterioridad a las Autoridades que correspondan y a los usuarios afectados.","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoActividad"=> "561120","descripcionLeyenda"=> "Ley N° 453: Los servicios deben suministrarse en condiciones de inocuidad, calidad y seguridad.","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
        ]);
           
    }
}
