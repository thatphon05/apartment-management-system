<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminBookingUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'parking_amount' => 'required|numeric|min:0',
            'arrival_date' => 'required|date',
        ];
    }

    public function attributes(): array
    {
        return [
            'parking_amount' => 'จำนวนที่จอดรถยนต์',
            'arrival_date' => 'วันที่จะเข้าพัก',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
