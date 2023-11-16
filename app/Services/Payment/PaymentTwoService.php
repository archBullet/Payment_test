<?php

declare(strict_types=1);

namespace App\Services\Payment;

use App\Contracts\PaymentServiceInterface;

class PaymentTwoService implements PaymentServiceInterface
{
    public function verifySignature($data): bool
    {
        $generatedSignature = $this->generateSignature($data);
        return $data['authorization'] === $generatedSignature;
    }

    public function generateSignature($data): string
    {
        $merchantKey = config('gatewayTwo.app_key');
        ksort($data);
        unset($data['authorization']);
        $parameterString = implode('.', $data);
        $signatureString = $parameterString . '.' . $merchantKey;
        return hash('MD5', $signatureString);
    }
}
