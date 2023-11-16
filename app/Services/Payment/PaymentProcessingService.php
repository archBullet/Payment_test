<?php

namespace App\Services\Payment;

use App\Models\Payment;
use Illuminate\Http\JsonResponse;

class PaymentProcessingService
{
    public function processPayment(array $validated): JsonResponse
    {
        $validated['user_id'] = 1;

        Payment::updateOrCreate(['payment_id' => $validated['payment_id']], $validated);

        return response()->json(['message' => 'Платеж успешно обработан'], 200, [
            'Content-Type' => 'application/json'
        ], JSON_UNESCAPED_UNICODE);
    }

    public function handleVerificationException(\Exception $e): JsonResponse
    {
        return response()->json(['message' => 'Произошла ошибка при обработке платежа'], 500, [
            'Content-Type' => 'application/json'
        ], JSON_UNESCAPED_UNICODE);
    }

    public function handleInvalidSignature(): JsonResponse
    {
        return response()->json(['message' => 'Неверная подпись'], 400, [
            'Content-Type' => 'application/json'
        ], JSON_UNESCAPED_UNICODE);
    }
}

