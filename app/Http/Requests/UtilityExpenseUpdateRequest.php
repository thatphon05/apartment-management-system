<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UtilityExpenseUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'water_unit' => ['required', 'numeric', 'min:0'],
            'electric_unit' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function attributes(): array
    {
        return [
            'water_unit' => 'มิเตอร์น้ำ',
            'electric_unit' => 'มิเตอร์ไฟ',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
