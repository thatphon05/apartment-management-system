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

        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
