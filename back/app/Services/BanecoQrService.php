<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class BanecoQrService
{
    protected string $baseUrl;
    protected string $aesKey;
    protected string $username;
    protected string $password;
    protected string $accountCredit;
    protected ?string $branchCode;
    protected ?string $caCert;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('baneco.base_url'), '/');
        $this->aesKey = config('baneco.aes_key');
        $this->username = config('baneco.username');
        $this->password = config('baneco.password');
        $this->accountCredit = config('baneco.account_credit');
        $this->branchCode = config('baneco.branch_code');
        $this->caCert = config('baneco.ca_cert');
    }

    protected function http(): PendingRequest
    {
        $http = Http::baseUrl($this->baseUrl)->acceptJson()->asJson()->timeout(30);
        if ($this->caCert && file_exists($this->caCert)) {
            $http = $http->withOptions(['verify' => $this->caCert]);
        }
        return $http;
    }

    protected function assertOk(Response $response, string $context): void
    {
        if ($response->failed()) {
            throw new RuntimeException("Error Baneco [$context]: HTTP {$response->status()} {$response->body()}");
        }
    }

    public function encrypt(string $text): string
    {
        $response = $this->http()->get('/api/authentication/encrypt', [
            'text' => $text,
            'aesKey' => $this->aesKey,
        ]);
        $this->assertOk($response, 'encrypt');

        return trim($response->body(), "\" \r\n\t");
    }

    protected function token(): string
    {
        return Cache::remember('baneco_qr_token', now()->addMinutes(25), function () {
            $encryptedPassword = $this->encrypt($this->password);
            $response = $this->http()->post('/api/authentication/authenticate', [
                'userName' => $this->username,
                'password' => $encryptedPassword,
            ]);
            $this->assertOk($response, 'authenticate');
            $data = $response->json();

            if (($data['responseCode'] ?? null) !== 0 || empty($data['token'])) {
                throw new RuntimeException('Fallo autenticación Baneco: '.($data['message'] ?? 'sin token'));
            }

            return $data['token'];
        });
    }

    protected function authed(): PendingRequest
    {
        return $this->http()->withToken($this->token());
    }

    public function generateQr(float $amount, string $description, string $transactionId): array
    {
        $response = $this->authed()->post('/api/qrsimple/generateQR', [
            'transactionId' => $transactionId,
            'accountCredit' => $this->encrypt($this->accountCredit),
            'currency' => 'BOB',
            'amount' => $amount,
            'description' => $description,
            'dueDate' => now()->addDay()->format('Y-m-d'),
            'singleUse' => true,
            'modifyAmount' => false,
            'branchCode' => $this->branchCode,
        ]);
        $this->assertOk($response, 'generateQR');
        $data = $response->json();

        if (($data['responseCode'] ?? null) !== 0) {
            throw new RuntimeException('Fallo generateQR: '.($data['message'] ?? ''));
        }
        if (empty($data['qrImage'])) {
            throw new RuntimeException('Fallo generateQR: no se recibió la imagen del QR.');
        }

        return [
            'qrId' => $data['qrId'],
            'qrImage' => 'data:image/png;base64,'.$data['qrImage'],
        ];
    }

    public function statusQr(string $qrId): array
    {
        $response = $this->authed()->get('/api/qrsimple/v2/statusQR/'.rawurlencode($qrId));
        $this->assertOk($response, 'statusQR');
        $data = $response->json();

        if (($data['responseCode'] ?? null) !== 0) {
            throw new RuntimeException('Fallo statusQR: '.($data['message'] ?? ''));
        }

        return $data;
    }

    public function cancelQr(string $qrId): void
    {
        $this->authed()->delete('/api/qrsimple/cancelQR', ['qrId' => $qrId]);
    }

    /**
     * Lista de QR pagados en una fecha puntual (formato yyyyMMdd).
     */
    public function paidQr(string $fecha): array
    {
        $response = $this->authed()->get('/api/qrsimple/v2/paidQR/'.$fecha);
        $this->assertOk($response, 'paidQR');
        $data = $response->json();

        if (($data['responseCode'] ?? null) !== 0) {
            throw new RuntimeException('Fallo paidQR: '.($data['message'] ?? ''));
        }

        return $data['paymentList'] ?? [];
    }
}
