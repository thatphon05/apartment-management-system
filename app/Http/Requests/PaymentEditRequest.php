<?php

namespace App\Http\Requests;

use App\Enums\PaymentStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class PaymentEditRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'status' => [new Enum(PaymentStatusEnum::class)]
        ];
    }

    public function messages(): array
    {
        return [

        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
