<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminConfigurationRequest extends FormRequest
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
            'deposit' => 'required|numeric|min:0',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'ประเภทห้อง',
            'rent_fee' => 'ค่าเช่าห้อง',
            'electric_fee' => 'ค่าเช่าห้องไฟฟ้า',
            'water_fee' => 'ค่าน้ำประปา',
            'parking_fee' => 'ค่าที่จอดรถยนต์',
            'common_fee' => 'ค่าส่วนกลาง',
            'overdue_fee' => 'ค่าปรับชำระเลยกำหนด',
            'deposit' => 'ค่ามัดจำ',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
