<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RepairCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'booking_id' => 'required',
            'subject' => 'required|string',
            'description' => 'required|string',
        ];
    }

    public function attributes(): array
    {
        return [
            'subject' => 'เรื่องที่แจ้ง',
            'description' => 'รายละเอียด',
        ];
    }

    public function messages(): array
    {
        return [
            'booking_id' => [
                'required' => 'กรุณาเลือกห้อง',
            ],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
