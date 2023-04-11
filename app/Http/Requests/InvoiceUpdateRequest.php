<?php

namespace App\Http\Requests;

use App\Enums\InvoiceStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class InvoiceUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status' => [new Enum(InvoiceStatusEnum::class)],
        ];
    }

    public function attributes(): array
    {
        return [
            'status' => 'สถานะ',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
