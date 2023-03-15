<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;

class SaleController extends Controller{
    public function index(){}
    public function store(StoreSaleRequest $request){


    }
    public function anularSale(Request $request){

        $codigoAmbiente=env('AMBIENTE');
        $codigoDocumentoSector=1; // 1 compraventa 2 alquiler 23 prevaloradas
        $codigoEmision=1; // 1 online 2 offline 3 masivo
        $codigoModalidad=env('MODALIDAD'); //1 electronica 2 computarizada
        $codigoPuntoVenta=$request->sale['codigoPuntoVenta'];
        $codigoSistema=env('CODIGO_SISTEMA');
        $tipoFacturaDocumento=1; // 1 con credito fiscal 2 sin creditofical 3 nota debito credito
        $codigoSucursal=$request->sale['codigoSucursal'];
        $nit=ENV('NIT');

        $user=User::find($request->user()->id);

        if (Cui::where('codigoPuntoVenta', $codigoPuntoVenta)->where('codigoSucursal', $codigoSucursal)->where('fechaVigencia','>=', now())->count()==0){
            return response()->json(['message' => 'No existe CUI para la venta!!'], 400);
        }
        if (Cufd::where('codigoPuntoVenta', $codigoPuntoVenta)->where('codigoSucursal', $codigoSucursal)->where('fechaVigencia','>=', now())->count()==0){
            return response()->json(['message' => 'No exite CUFD para la venta!!'], 400);
        }
        $cui=Cui::where('codigoPuntoVenta', $codigoPuntoVenta)->where('codigoSucursal', $codigoSucursal)->where('fechaVigencia','>=', now())->first();
        $cufd=Cufd::where('codigoPuntoVenta', $codigoPuntoVenta)->where('codigoSucursal', $codigoSucursal)->where('fechaVigencia','>=', now())->first();

        //codigomotivo
        //cuf

        try {
            //return 'llega';
            $client = new \SoapClient(env("URL_SIAT")."ServicioFacturacionCompraVenta?WSDL",  [
                'stream_context' => stream_context_create([
                    'http' => [
                        'header' => "apikey: TokenApi " . env('TOKEN'),
                    ]
                ]),
                'cache_wsdl' => WSDL_CACHE_NONE,
                'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE,
                'trace' => 1,
                'use' => SOAP_LITERAL,
                'style' => SOAP_DOCUMENT,
            ]);
            $result= $client->anulacionFactura([
                "SolicitudServicioAnulacionFactura"=>[
                    "codigoAmbiente"=>$codigoAmbiente,
                    "codigoDocumentoSector"=>$codigoDocumentoSector,
                    "codigoEmision"=>$codigoEmision,
                    "codigoModalidad"=>$codigoModalidad,
                    "codigoPuntoVenta"=>$codigoPuntoVenta,
                    "codigoSistema"=>$codigoSistema,
                    "codigoSucursal"=>$codigoSucursal,
                    "cufd"=>$cufd->codigo,
                    "cuis"=>$request->sale['cui'],
                    "nit"=>env('NIT'),
                    "tipoFacturaDocumento"=>$tipoFacturaDocumento,
                    "codigoMotivo"=>$request->motivo['codigoClasificador'],
                    "cuf"=>$request->sale['cuf']
                ]
            ]);
            //return $result;
            if($result->RespuestaServicioFacturacion->transaccion){
                $sale=Sale::find($request->sale['id']);
                $sale->siatAnulado=1;
                $sale->save();
                $client=Client::find($sale->client_id);
//                error_log(json_encode($client));
                if ($client->email!=''){
                    $details=[
                        "title"=>"Factura",
                        "body"=>"Factura anulada",
                        "online"=>true,
                        "anulado"=>true,
                        "cuf"=>$sale->cuf,
                        "numeroFactura"=>$sale->numeroFactura,
                        "sale_id"=>$sale->id,
                        "carpeta"=>"archivos",
                    ];
                    Mail::to($client->email)->send(new TestMail($details));
                }

            }
            return $result;

        }catch (\Exception $e) {
            //return response()->json(['error' => $e->getMessage()]);
            return response()->json(['message' => 'anulado error'], 400);
        }
    }
}
