<?php

namespace App\Http\Controllers;

use App\Models\DetailOrder;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $order = Order::create([
            'fecha' => date('Y-m-d'), // date('Y-m-d H:i:s'
            'hora' => date('H:i:s'),
            'mesa' => $request->mesa,
            'status' => 'PENDIENTE', // PENDIENTE, REALIZADO, CANCELADO
            'sale_id' => null
        ]);

        foreach ($request->detail as $detail) {
            DetailOrder::create([
                'cantidad' => $detail['cantidad'],
                'precio' => $detail['precio'],
                'producto' => $detail['producto'],
                'order_id' => $order->id,
                'product_id' => $detail['product_id'],
            ]);
        }

        return response()->json([
            'message' => 'Orden creada con exito',
            'order' => $order,
        ], 201);
    }

    public function buscarOrder(Request $request){
        return Order::with('detailorders')->whereDate('fecha',$request->fecha)->get();
    }

    
}
