<?php

declare(strict_types=1);

namespace App\Contracts;

interface PaymentServiceInterface
{
    public function verifySignature($data);

    public function generateSignature($data);
}
