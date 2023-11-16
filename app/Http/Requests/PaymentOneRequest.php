<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaymentOneRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'merchant_id' => ['required', 'integer'],
            'payment_id' => ['required', 'integer'],
            'status' => ['required', 'string', Rule::in(['new', 'pending', 'completed', 'expired', 'rejected'])],
            'amount' => ['required', 'integer'],
            'amount_paid' => ['required', 'integer'],
            'timestamp' => ['required', 'integer'],
            'sign' => ['required', 'string']
        ];
    }
}
