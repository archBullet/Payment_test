<?php

declare(strict_types=1);

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentOneRequest;
use App\Services\Payment\PaymentOneService;
use App\Services\Payment\PaymentProcessingService;
use Illuminate\Http\JsonResponse;

class PaymentOneController extends Controller
{
    public function __construct(
        private readonly PaymentOneService        $paymentService,
        private readonly PaymentProcessingService $paymentProcessingService
    )
    {
    }

    /**
     * @param PaymentOneRequest $request
     * @return JsonResponse
     */
    public function index(PaymentOneRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();
            $verified = $this->paymentService->verifySignature($validated);

            if ($verified) {
                return $this->paymentProcessingService->processPayment($validated);
            } else {
                return $this->paymentProcessingService->handleInvalidSignature();
            }
        } catch (\Exception $e) {
            return $this->paymentProcessingService->handleVerificationException($e);
        }
    }
}
