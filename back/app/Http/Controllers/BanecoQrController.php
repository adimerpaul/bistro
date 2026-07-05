<?php

namespace App\Http\Controllers;

use App\Services\BanecoQrService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Throwable;

class BanecoQrController extends Controller
{
    public function __construct(protected BanecoQrService $baneco)
    {
    }

    public function generar(Request $request)
    {
        $request->validate([
            'monto' => 'required|numeric|min:0.01',
            'descripcion' => 'nullable|string|max:150',
        ]);

        try {
            $transactionId = 'POS'.$request->user()->id.'-'.now()->format('YmdHisv');
            $data = $this->baneco->generateQr(
                round((float) $request->monto, 2),
                $request->descripcion ?? 'Venta POS',
                $transactionId
            );

            return response()->json($data);
        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function estado(string $qrId)
    {
        try {
            $data = $this->baneco->statusQr($qrId);
            $statusCode = (int) ($data['statusQrCode'] ?? $data['statusQRCode'] ?? -1);

            return response()->json([
                'pagado' => $statusCode === 1,
                'anulado' => $statusCode === 9,
                'statusQrCode' => $statusCode,
                'payment' => $data['payment'] ?? null,
            ]);
        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function cancelar(string $qrId)
    {
        try {
            $this->baneco->cancelQr($qrId);

            return response()->json(['message' => 'ok']);
        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function pagados(Request $request)
    {
        $request->validate([
            'ini' => 'required|date',
            'fin' => 'required|date|after_or_equal:ini',
        ]);

        $ini = Carbon::parse($request->ini)->startOfDay();
        $fin = Carbon::parse($request->fin)->startOfDay();

        if ($ini->diffInDays($fin) > 31) {
            return response()->json(['message' => 'El rango máximo permitido es de 31 días.'], 422);
        }

        try {
            $pagos = [];
            for ($dia = $ini->copy(); $dia->lte($fin); $dia->addDay()) {
                foreach ($this->baneco->paidQr($dia->format('Ymd')) as $pago) {
                    $pagos[] = $pago;
                }
            }

            return response()->json($pagos);
        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
