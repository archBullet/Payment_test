<?php

namespace App\Contracts;

interface PaymentServiceInterface
{
    public function verifySignature($data);

    public function generateSignature($data);
}
