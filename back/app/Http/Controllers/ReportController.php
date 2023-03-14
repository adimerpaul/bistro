<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
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
        //
        return Sale::with("client")->with("details")->with("user")
        ->whereDate("fechaEmision",">=", $request->ini)
        ->whereDate("fechaEmision","<=", $request->fin)
        ->where("tipo",$request->tipo)->get();
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
}
