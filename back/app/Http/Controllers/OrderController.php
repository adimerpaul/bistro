<?php

namespace App\Http\Controllers;

use App\Models\DetailOrder;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderPending()
    {
        $orders= Order::where('status', 'PENDIENTE')->get();
//        $orders->forEach(function ($order){
//            $order->TextProducts = '';
//            $order->detailorders->forEach(function ($detailorder) use ($order){
//                $order->TextProducts .= $detailorder->cantidad.' '.$detailorder->producto.' ';
//            });
//        });
        for ($i=0;$i<count($orders);$i++){
            $orders[$i]->TextProducts = '';
            for ($j=0;$j<count($orders[$i]->detailorders);$j++){
                $orders[$i]->TextProducts .= $orders[$i]->detailorders[$j]->cantidad.' '.$orders[$i]->detailorders[$j]->producto.' ';
            }
        }
        return $orders;
    }
    public function store(Request $request)
    {
//        error_log(json_decode($request->getContent(), true)); // Mostrará los datos en el log

        $order = Order::create([
            'fecha' => date('Y-m-d'), // date('Y-m-d H:i:s'
            'hora' => date('H:i:s'),
            'mesa' => $request->mesa,
            'status' => 'PENDIENTE', // PENDIENTE, REALIZADO, CANCELADO
            'sale_id' => null
        ]);

        $detailData = [];
        $total = 0;

        if ($request->detail != null) {
            $detailArray = json_decode($request->detail, true); // Decodificar la cadena JSON
            foreach ($detailArray as $detail) {
                $total += $detail['cantidadCarrito'] * $detail['price'];
                $detailData[] = [
                    'cantidad' => $detail['cantidadCarrito'],
                    'precio' => $detail['price'],
                    'producto' => $detail['name'],
                    'order_id' => $order->id,
                    'product_id' => $detail['id'],
                    'llevar' => $detail['llevar'],
                    'subtotal' => $detail['cantidadCarrito'] * $detail['price'],
                ];
            }
            $order->total = $total;
            $order->save();
            DetailOrder::insert($detailData);
        }
        $this->soketIO('order', ['order' => Order::where('id', $order->id)->with('detailorders')->first()]);

        return response()->json([
            'message' => 'Orden creada con éxito',
            'order' => $order,
        ], 201);
    }



    public function buscarOrder(Request $request){
        return Order::with('detailorders')->whereDate('fecha',$request->fecha)->get();
    }

    public function cancelOrder($id){
        $order = Order::find($id);
        $order->status='CANCELADO';
        $order->save();
    }


}
