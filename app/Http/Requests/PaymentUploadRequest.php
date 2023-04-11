<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentUploadRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'slip' => 'required|file|image',
        ];
    }

    public function attributes(): array
    {
        return [
            'slip' => 'สลิปโอนเงิน',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
