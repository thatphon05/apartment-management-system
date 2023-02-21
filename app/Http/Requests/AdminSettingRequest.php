<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminSettingRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => 'required',
            'rent_fee' => 'required|numeric|min:0',
            'electric_fee' => 'required|numeric|min:0',
            'water_fee' => 'required|numeric|min:0',
            'parking_fee' => 'required|numeric|min:0',
            'common_fee' => 'required|numeric|min:0',
            'overdue_fee' => 'required|numeric|min:0',
            'deposit' => 'required|numeric|min:0'
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
