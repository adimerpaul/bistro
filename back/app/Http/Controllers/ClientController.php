<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use Illuminate\Http\Request;

class ClientController extends Controller{
    public function index(){
        return Client::all();
    }

    public function searchClient(Request $request)
    {
//        return $request->has('complemento');
        if ($request->has('complemento') && $request->complemento != '') {
            $clients = Client::where('numeroDocumento',  $request->numeroDocumento)->where('complemento',  $request->complemento)->first();
        } else {
            $clients = Client::where('numeroDocumento',  $request->numeroDocumento)->where('complemento','')->first();
        }
        return $clients;
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        //
        $client=Client::find($request->id);
        $client->nombreRazonSocial=strtoupper($request->nombreRazonSocial);
        $client->codigoTipoDocumentoIdentidad=$request->codigoTipoDocumentoIdentidad;
        $client->email=$request->email;
        $client->save();
    }
}
