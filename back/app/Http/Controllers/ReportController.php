<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Shop;
use App\Models\Motivo;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function motivoanular(){
        return Motivo::all();
    }

    /**
     * Display the specified resource.
     */
    public function datocine($id){
        $shop=Shop::find($id);
        $nit=env('NIT');
        $razon=$shop->nombre;
        $dir=env("DIRECCION");
        $tel=env("TELEFONO");
        $url=env("URL_SIAT");
        $url2=env("URL_SIAT2");
        return json_encode(['nit'=>$nit,'razon'=>$razon,'direccion'=>$dir,'telefono'=>$tel,'url'=>$url,'url2'=>$url2]);
    }

    public function listado(Request $request)
    {
        //        return $request;
        return Sale::with("client")->with("details")->with("user")
        ->whereDate("fechaEmision",">=", $request->ini)
        ->whereDate("fechaEmision","<=", $request->fin)
        ->where("tipo",$request->tipo)
        ->get();
    }

    public function show( $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function resumenRF(Request $request){
        $cadena='';
        if($request->id!=0)  $cadena='and s.user_id=' .$request->id;
        return DB::SELECT("SELECT
        (SELECT  sum(d.subTotal)
        from sales s inner join details d on s.id=d.sale_id
        where
        date(s.fechaEmision) >='$request->ini'
        and date(s.fechaEmision) <='$request->fin'
        ".$cadena."
        and s.tipo='$request->tipo'
        and s.siatAnulado=false
        and s.credito='SI'
        and s.venta='R') as tarjetaR,
        (SELECT sum(d.subTotal)
        from sales s inner join details d on s.id=d.sale_id
        where date(s.fechaEmision)>='$request->ini'
        and date(s.fechaEmision)<='$request->fin'
        ".$cadena."
        and s.tipo='$request->tipo'
        and s.siatAnulado=false
        and s.vip='NO'
		and s.credito='NO'
        and s.cortesia='NO'
        and s.venta='R') as efectivoR,
        (SELECT  sum(d.subTotal)
        from sales s inner join details d on s.id=d.sale_id
        where
        date(s.fechaEmision) >='$request->ini'
        and date(s.fechaEmision) <='$request->fin'
        ".$cadena."
        and s.tipo='$request->tipo'
        and s.siatAnulado=false
        and s.credito='SI'
        and s.venta='F') as tarjetaF,
        (SELECT sum(d.subTotal)
        from sales s inner join details d on s.id=d.sale_id
        where date(s.fechaEmision)>='$request->ini'
        and date(s.fechaEmision)<='$request->fin'
        ".$cadena."
        and s.tipo='$request->tipo'
        and s.siatAnulado=false
        and s.vip='NO'
		and s.credito='NO'
        and s.cortesia='NO'
        and s.venta='F') as efectivoF ");
    }

    public function resumen(Request $request){
        $cadena='';
        if($request->id!=0)  $cadena='and s.user_id=' .$request->id;
        return DB::SELECT("SELECT
        (SELECT  sum(d.subTotal)
        from sales s inner join details d on s.id=d.sale_id
        where
        date(s.fechaEmision) >='$request->ini'
        and date(s.fechaEmision) <='$request->fin'
        ".$cadena."
        and s.tipo='$request->tipo'
        and s.siatAnulado=false
        and s.credito='SI') as tarjeta,
        (SELECT  sum(d.subTotal)
        from sales s inner join details d on s.id=d.sale_id
        where
        date(s.fechaEmision) >='$request->ini'
        and date(s.fechaEmision) <='$request->fin'
        ".$cadena."
        and s.tipo='$request->tipo'
        and s.siatAnulado=false
        and s.vip='SI') as vip,
        (SELECT  sum(d.subTotal)
        from sales s inner join details d on s.id=d.sale_id
        where
        date(s.fechaEmision) >='$request->ini'
        and date(s.fechaEmision) <='$request->fin'
        ".$cadena."
        and s.tipo='$request->tipo'
        and s.siatAnulado=false
        and s.vip='NO'
		and s.credito='NO') as efectivo ");
    }

    public function caja(Request $request){
        $cadena='';
        if($request->id!=0)  $cadena='and s.user_id=' .$request->id;

        return DB::SELECT("SELECT d.descripcion,d.product_id, sum(d.subTotal) total,sum(d.cantidad) cantidad
        from sales s inner join details d on s.id=d.sale_id
        where date(s.fechaEmision)>='$request->ini'
        and date(s.fechaEmision)<='$request->fin'
        ".$cadena."
        and s.tipo='$request->tipo'
        and s.siatAnulado=false
        GROUP by  d.product_id,d.descripcion");
    }

    public function cajaF(Request $request){
        $cadena='';
        if($request->id!=0)  $cadena='and s.user_id=' .$request->id;

        return DB::SELECT("SELECT d.descripcion,d.product_id, sum(d.subTotal) total,sum(d.cantidad) cantidad
        from sales s inner join details d on s.id=d.sale_id
        where date(s.fechaEmision)>='$request->ini'
        and date(s.fechaEmision)<='$request->fin'
        ".$cadena."
        and s.tipo='$request->tipo'
        and s.siatAnulado=false

        and s.cortesia='NO'
        and s.venta='F'
        GROUP by  d.product_id,d.descripcion");
    }

    public function cajaFefectivo(Request $request){
        $cadena='';
        if($request->id!=0)  $cadena='and s.user_id=' .$request->id;

        return DB::SELECT("SELECT sum(d.subTotal) total
        from sales s inner join details d on s.id=d.sale_id
        where date(s.fechaEmision)>='$request->ini'
        and date(s.fechaEmision)<='$request->fin'
        ".$cadena."
        and s.tipo='$request->tipo'
        and s.siatAnulado=false
        and s.vip='NO'
		and s.credito='NO'
        and s.cortesia='NO'
        and s.venta='F'
        ");
    }
    public function cajaRefectivo(Request $request){
        $cadena='';
        if($request->id!=0)  $cadena='and s.user_id=' .$request->id;

        return DB::SELECT("SELECT sum(d.subTotal) total
        from sales s inner join details d on s.id=d.sale_id
        where date(s.fechaEmision)>='$request->ini'
        and date(s.fechaEmision)<='$request->fin'
        ".$cadena."
        and s.tipo='$request->tipo'
        and s.siatAnulado=false
        and s.vip='NO'
		and s.credito='NO'
        and s.cortesia='NO'
        and s.venta='R'
        ");
    }

    public function cajaR(Request $request){
        $cadena='';
        if($request->id!=0)  $cadena='and s.user_id=' .$request->id;

        return DB::SELECT("SELECT d.descripcion,d.product_id, sum(d.subTotal) total,sum(d.cantidad) cantidad
        from sales s inner join details d on s.id=d.sale_id
        where date(s.fechaEmision)>='$request->ini'
        and date(s.fechaEmision)<='$request->fin'
        ".$cadena."
        and s.tipo='$request->tipo'
        and s.siatAnulado=false

        and s.cortesia='NO'
        and s.venta='R'
        GROUP by  d.product_id,d.descripcion");
        //and s.vip='NO'
		//and s.credito='NO'
    }
    public function usercaja(Request $request){  //and s.siatEnviado=true
        $cadena='';
        return DB::SELECT("
        SELECT u.name usuario,SUM(s.montoTotal) total
        from users u INNER JOIN sales s on u.id=s.user_id
        where date(s.fechaEmision)>='$request->ini'
        and date(s.fechaEmision)<='$request->fin'
        and s.tipo='$request->tipo'
        and s.siatAnulado=false

        and s.credito='NO'
        and s.vip='NO'
        group by  u.name;
        ");
    }
}
