<?php

declare(strict_types=1);

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentTwoRequest;
use App\Services\Payment\PaymentProcessingService;
use App\Services\Payment\PaymentTwoService;
use Illuminate\Http\JsonResponse;

class PaymentTwoController extends Controller
{
    public function __construct(
        private readonly PaymentTwoService        $paymentService,
        private readonly PaymentProcessingService $paymentProcessingService
    )
    {
    }

    /**
     * @param PaymentTwoRequest $request
     * @return JsonResponse
     */
    public function index(PaymentTwoRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();

            $validated['authorization'] = $request->headers->all('authorization')[0];

            $verified = $this->paymentService->verifySignature($validated);

            if ($verified) {

                $validated['merchant_id'] = $validated['project'];
                $validated['payment_id'] = $validated['invoice'];
                unset($validated['project']);
                unset($validated['invoice']);

                return $this->paymentProcessingService->processPayment($validated);
            } else {
                return $this->paymentProcessingService->handleInvalidSignature();
            }
        } catch (\Exception $e) {
            return $this->paymentProcessingService->handleVerificationException($e);
        }
    }
}

