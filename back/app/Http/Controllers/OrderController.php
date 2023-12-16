<?php

namespace App\Http\Controllers;

use App\Models\DetailOrder;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        error_log(json_decode($request->getContent(), true)); // Mostrará los datos en el log

        $detailArray = json_decode($request->detail, true); // Decodificar la cadena JSON

        $order = Order::create([
            'fecha' => date('Y-m-d'), // date('Y-m-d H:i:s'
            'hora' => date('H:i:s'),
            'mesa' => $request->mesa,
            'status' => 'PENDIENTE', // PENDIENTE, REALIZADO, CANCELADO
            'sale_id' => null
        ]);

        $detailData = [];

        foreach ($detailArray as $detail) {
            $detailData[] = [
                'cantidad' => $detail['cantidadCarrito'],
                'precio' => $detail['price'],
                'producto' => $detail['name'],
                'order_id' => $order->id,
                'product_id' => $detail['id'],
            ];
        }

        DetailOrder::insert($detailData);

        return response()->json([
            'message' => 'Orden creada con éxito',
            'order' => $order,
        ], 201);
    }



    public function buscarOrder(Request $request){
        return Order::with('detailorders')->whereDate('fecha',$request->fecha)->get();
    }
}
