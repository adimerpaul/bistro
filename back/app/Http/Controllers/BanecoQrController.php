<?php

namespace App\Http\Controllers;

use App\Models\Sale;
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

            $qrIds = array_values(array_filter(array_map(fn ($p) => $p['qrId'] ?? null, $pagos)));
            $sales = Sale::whereIn('qrId', $qrIds)->get()->keyBy('qrId');

            foreach ($pagos as &$pago) {
                $sale = $sales[$pago['qrId'] ?? ''] ?? null;
                $pago['sale'] = $sale ? [
                    'id' => $sale->id,
                    'tipo' => $sale->tipo,
                    'montoTotal' => $sale->montoTotal,
                    'usuario' => $sale->usuario,
                    'fechaEmision' => $sale->fechaEmision,
                    'venta' => $sale->venta,
                ] : null;
            }
            unset($pago);

            return response()->json($pagos);
        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function ventasParaVincular(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'tipo' => 'required|string',
        ]);

        return Sale::whereDate('fechaEmision', $request->fecha)
            ->where('tipo', $request->tipo)
            ->where('siatAnulado', false)
            ->whereNull('qrId')
            ->orderByDesc('fechaEmision')
            ->get(['id', 'fechaEmision', 'montoTotal', 'usuario', 'venta', 'tipo']);
    }

    public function vincular(Request $request)
    {
        $request->validate([
            'qrId' => 'required|string',
            'sale_id' => 'required|integer|exists:sales,id',
        ]);

        if (Sale::where('qrId', $request->qrId)->where('id', '!=', $request->sale_id)->exists()) {
            return response()->json(['message' => 'Este QR ya está vinculado a otra venta.'], 422);
        }

        $sale = Sale::findOrFail($request->sale_id);
        $sale->qr = 'SI';
        $sale->qrId = $request->qrId;
        $sale->save();

        return response()->json($sale);
    }

    public function desvincular(Request $request)
    {
        $request->validate([
            'sale_id' => 'required|integer|exists:sales,id',
        ]);

        $sale = Sale::findOrFail($request->sale_id);
        $sale->qr = 'NO';
        $sale->qrId = null;
        $sale->save();

        return response()->json($sale);
    }
}
