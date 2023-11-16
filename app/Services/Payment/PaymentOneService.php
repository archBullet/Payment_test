<?php

declare(strict_types=1);

namespace App\Services\Payment;

use App\Contracts\PaymentServiceInterface;

class PaymentOneService implements PaymentServiceInterface
{
    public function verifySignature($data): bool
    {
        $generatedSignature = $this->generateSignature($data);
        return $data['sign'] === $generatedSignature;
    }

    public function generateSignature($data): string
    {
        $merchantKey = config('gatewayOne.merchant_key');
        ksort($data);
        unset($data['sign']);
        $parameterString = implode(':', $data);
        $signatureString = $parameterString . ':' . $merchantKey;
        return hash('sha256', $signatureString);
    }
}
