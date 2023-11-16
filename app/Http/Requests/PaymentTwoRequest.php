<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaymentTwoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $requiredHeader = 'authorization';

        if (!$this->header($requiredHeader)) {
            return false;
        }

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
            'project' => ['required', 'integer'],
            'invoice' => ['required', 'integer'],
            'status' => ['required', 'string', Rule::in(['created', 'inprogress', 'paid', 'expired', 'rejected'])],
            'amount' => ['required', 'integer'],
            'amount_paid' => ['required', 'integer'],
            'rand' => ['required', 'string']
        ];
    }
}
