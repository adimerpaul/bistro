<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table("messages")->insert([
            [ "codigoClasificador"=> "1","descripcion"=> "BOBINAS","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "123","descripcion"=> "CODIGO UNICO DE FACTURACION DIARIA (CUFD) FUERA DE TOLERANCIA","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "901","descripcion"=> "RECEPCION PENDIENTE","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "902","descripcion"=> "RECEPCION RECHAZADA","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "903","descripcion"=> "RECEPCION PROCESADA","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "904","descripcion"=> "RECEPCION OBSERVADA","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "905","descripcion"=> "ANULACION CONFIRMADA","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "906","descripcion"=> "ANULACION RECHAZADA","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "907","descripcion"=> "REVERSION DE ANULACION CONFIRMADA","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "908","descripcion"=> "RECEPCION VALIDADA","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "909","descripcion"=> "REVERSION DE ANULACION RECHAZADA","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "910","descripcion"=> "EL PARAMETRO AMBIENTE ES INVALIDO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "911","descripcion"=> "EL PARAMETRO CODIGO DE SISTEMA ES INVALIDO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "912","descripcion"=> "EL SISTEMA NO ESTA ASOCIADO AL CONTRIBUYENTE","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "913","descripcion"=> "CODIGO UNICO DE INICIO DE SISTEMA (CUIS) INVALIDO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "914","descripcion"=> "CODIGO UNICO DE FACTURACION DIARIA (CUFD) INVALIDO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "915","descripcion"=> "EL PARAMETRO TIPO FACTURA DOCUMENTO ES INVALIDO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "916","descripcion"=> "EL PARAMETRO TIPO DE EMISION ES INVALIDO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "917","descripcion"=> "EL PARAMETRO MODALIDAD ES INVALIDO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "918","descripcion"=> "EL PARAMETRO SUCURSAL ES INVALIDO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "919","descripcion"=> "EL PARAMETRO NIT ES INVALIDO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "920","descripcion"=> "EL PARAMETRO ARCHIVO ES INVALIDO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "921","descripcion"=> "EL FIRMADO DEL XML ES INCORRECTO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "922","descripcion"=> "LA FIRMA DEL XML NO CORRESPONDE AL CONTRIBUYENTE","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "923","descripcion"=> "EL PARAMETRO CODIGO DE RECEPCION ES INVALIDO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "924","descripcion"=> "LA FACTURA O NOTA, NO EXISTE EN LA BASE DE DATOS DEL SIN","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "925","descripcion"=> "EL PARAMETRO MOTIVO DE ANULACION ES INVALIDO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "926","descripcion"=> "COMUNICACION EXITOSA","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "927","descripcion"=> "EL CERTIFICADO DE LA FIRMA ES INVALIDO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "928","descripcion"=> "EL CERTIFICADO SE ENCUENTRA REVOCADO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "929","descripcion"=> "EL CODIGO UNICO DE INICIO DE SISTEMA (CUIS) NO ESTA VIGENTE","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "930","descripcion"=> "EL CODIGO UNICO DE INICIO DE SISTEMA (CUIS) NO CORRESPONDE A LA SUCURSAL/PUNTO VENTA","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "931","descripcion"=> "EL PARAMETRO CODIGO DOCUMENTO SECTOR ES INVALIDO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "932","descripcion"=> "EL PARAMETRO CODIGO DOCUMENTO SECTOR NO CORRESPONDE AL SERVICIO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "933","descripcion"=> "EL PUNTO DE VENTA ES INEXISTENTE O INVALIDO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "934","descripcion"=> "LA SOLICITUD DE ANULACION DE LA FACTURA O NOTA DE CREDITO-DEBITO SE ENCUENTRA FUERA DE PLAZO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "935","descripcion"=> "EL PARAMETRO FECHA DE ENVIO ES INVALIDO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "936","descripcion"=> "LA FACTURA O NOTA DE CREDITO-DEBITO YA SE ENCUENTRA ANULADA","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "937","descripcion"=> "EL NIT NO TIENE ASOCIADO LA MODALIDAD DE FACTURACION","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "938","descripcion"=> "EL NIT PRESENTA MARCAS DE CONTROL","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "939","descripcion"=> "LA FACTURA O NOTA DE CREDITO - DEBITO NO CUMPLE CON EL FORMATO DEL XSD ESPECIFICADO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "940","descripcion"=> "EL NIT NO TIENE HABILITADO EL DOCUMENTO SECTOR","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "941","descripcion"=> "LA FACTURA O NOTA DE CREDITO - DEBITO NO SE ENCUENTRA DISPONIBLE PARA SER ANULADA","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "942","descripcion"=> "EL CODIGO DE RECEPCION DE EVENTO SIGNIFICATIVO NO SE ENCUENTRA EN LA BASE DE DATOS DEL SIN","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "943","descripcion"=> "EL FORMATO DE LA FECHA DE ENVIO ES INCORRECTO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "944","descripcion"=> "EL CODIGO DE RECEPCION NO SE ENCUENTRA EN LA BASE DE DATOS DEL SIN","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "945","descripcion"=> "EL ESTADO DE RECEPCION DE LA ANULACION ES INCORRECTA","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "946","descripcion"=> "EL CODIGO UNICO DE FACTURA (CUF) NO EXISTE EN BASE DE DATOS DEL SIN","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "947","descripcion"=> "EL PARAMETRO TIPO DE PUNTO DE VENTA ES INVALIDO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "948","descripcion"=> "EL PARAMETRO NOMBRE DE PUNTO DE VENTA NO PUEDE SER VACIO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "949","descripcion"=> "EL PARAMETRO DESCRIPCION DE PUNTO DE VENTA NO PUEDE SER VACIO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "950","descripcion"=> "EL PARAMETRO CODIGO DE EVENTO SIGNIFICATIVO NO PUEDE SER VACIO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "951","descripcion"=> "EL PARAMETRO DESCRIPCION DE EVENTO SIGNIFICATIVO NO PUEDE SER VACIO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "952","descripcion"=> "EL CODIGO UNICO DE FACTURA (CUF) YA SE ENCUENTRA REGISTRADO EN LA BASE DE DATOS DEL SIN","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "953","descripcion"=> "EL CODIGO UNICO DE FACTURACION DIARIA (CUFD) NO SE ENCUENTRA VIGENTE","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "954","descripcion"=> "LA CANTIDAD DE FACTURAS EN EL  PAQUETE EMITIDO POR CONTINGENCIA HA EXCEDIO EL MAXIMO PERMITIDO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "955","descripcion"=> "NO EXISTE REGISTRO PARA AUTORIZAR EL PROCESO MASIVO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "956","descripcion"=> "LA CANTIDAD DE FACTURAS EN EL PAQUETE EMITIDO MASIVAMENTE HA EXCEDIO EL MAXIMO PERMITIDO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "957","descripcion"=> "NO EXISTE REGISTRO DE EVENTO SIGNIFICATIVO EN LA BASE DE DATOS DEL SIN","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "958","descripcion"=> "EL USUARIO NO SE ENCUENTRA AUTORIZADO PARA CONSUMIR ESTE SERVICIO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "959","descripcion"=> "EL CODIGO UNICO DE INICIO DE SISTEMA (CUIS) NO SE ENCUENTRA ASOCIADO AL SISTEMA","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "960","descripcion"=> "EL PARAMETRO FIN DE EVENTO ES REQUERIDO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "961","descripcion"=> "EL NIT TIENE MARCA DE DOMICILIO INEXISTENTE","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "962","descripcion"=> "EL NIT TIENE BLOQUEO DE DOSIFICACION ORIGINADO EN FISCALIZACION","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "963","descripcion"=> "EL NIT TIENE BLOQUEO DE DOSIFICACION ORIGINADO EN JURIDICA","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "964","descripcion"=> "EL NIT NO CUMPLE CON OBLIGATORIEDAD DE PRESENTACION DE DDJJ","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "965","descripcion"=> "EL CONTRIBUYENTE NO CUENTA CON FIRMA VIGENTE REGISTRADA","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "966","descripcion"=> "NO SE PUEDE RECUPERAR LOS DATOS DEL CONTRIBUYENTE","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "967","descripcion"=> "TIEMPO DE ESPERA AGOTADO PARA CONEXION A BASE DE DATOS","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "968","descripcion"=> "LA ANULACION DE LA FACTURA O NOTA DE CREDITO - DEBITO YA SE ENCUENTRA REVERTIDA","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "969","descripcion"=> "EL PARAMETRO HASH ES INVALIDO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "970","descripcion"=> "EL CUIS EN LA BASE DE DATOS SE ENCUENTRA VIGENTE, NO PUEDE SOLICITAR OTRO","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "971","descripcion"=> "EL TAMAÑO DEL ARCHIVO EXCEDE EL TAMAÑO PERMITIDO DE 100 MB","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "972","descripcion"=> "LA CANTIDAD DE FACTURAS ENVIADA EN EL PAQUETE ES MAYOR A LA DEFINIDA EN LA NORMATIVA","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],
            [ "codigoClasificador"=> "973","descripcion"=> "EL CODIGO UNICO DE INICIO DE SISTEMA (CUIS) NO SE ENCUENTRA VIGENTE","codigoPuntoVenta"=>0,"codigoSucrsal"=>0],

        ]);
    }
}
