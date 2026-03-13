<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeideaPaymentService
{
    protected $baseUrl;

    protected $merchantKey;

    protected $password;

    public function __construct()
    {
        $this->baseUrl = config('services.geidea.base_url');
        $this->merchantKey = config('services.geidea.merchant_key');
        $this->password = config('services.geidea.password');
    }

    public function initiatePayment(array $data)
    {
        $response = Http::withBasicAuth($this->merchantKey, $this->password)
            ->post("{$this->baseUrl}/pgw/api/v2/direct/pay", [
                'amount' => $data['amount'],
                'currency' => 'SAR',
                'cardNumber' => $data['card_number'],
                'expiryMonth' => $data['expiry_month'],
                'expiryYear' => $data['expiry_year'],
                'cvv' => $data['cvv'],
                'merchantReferenceId' => $data['reference_id'],
                'callbackUrl' => $data['callback_url'],
            ]);

        return $response->json();
    }

    public function createSession(array $data)
    {
        $signature = $this->generateSignature(
            $this->merchantKey,
            $data['amount'],
            $data['currency'],
            $data['merchant_reference_id'],
            $this->password,
            $data['timestamp']
        );

        return Http::withBasicAuth($this->merchantKey, $this->password)
            ->post("{$this->baseUrl}/payment-intent/api/v2/direct/session", [
                'amount' => $data['amount'],
                'currency' => $data['currency'] ?? 'SAR',
                'merchantReferenceId' => $data['merchant_reference_id'],
                'timestamp' => $data['timestamp'],
                'signature' => $signature,
                'callbackUrl' => $data['callback_url'],
                'language' => $data['language'],
            ]);

    }

    private function generateSignature($merchantPublicKey, $orderAmount, $orderCurrency, $orderMerchantReferenceId, $apiPassword, $timestamp): string
    {
        $amountStr = number_format($orderAmount, 2, '.', '');
        $data = "{$merchantPublicKey}{$amountStr}{$orderCurrency}{$orderMerchantReferenceId}{$timestamp}";
        $hash = hash_hmac('sha256', $data, $apiPassword, true);

        return base64_encode($hash);
    }
}
