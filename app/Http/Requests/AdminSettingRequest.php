<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminSettingRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'rent_price' => 'required|numeric|min:0',
            'electric_price' => 'required|numeric|min:0',
            'water_price' => 'required|numeric|min:0',
            'parking_price' => 'required|numeric|min:0',
            'common_fee' => 'required|numeric|min:0',
            'damages_price' => 'required|numeric|min:0',
            'deposit' => 'required|numeric|min:0'
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'rent_price' => [
                'required' => 'คุณต้องใส่ค่าเช่าห้อง',
                'numeric' => 'ค่าเช่าห้องกรอกต้องเป็นตัวเลขเท่านั้น',
                'min' => 'ค่าเช่าห้องต้องมากกว่า 0',
            ],
            'electric_price' => [
                'required' => 'คุณต้องใส่ค่าไฟฟ้า',
                'numeric' => 'ค่าไฟฟ้ากรอกต้องเป็นตัวเลขเท่านั้น',
                'min' => 'ค่าไฟฟ้าต้องมากกว่า 0',
            ],
            'water_price' => [
                'required' => 'คุณต้องใส่ค่าน้ำประปา',
                'numeric' => 'ค่าน้ำประปากรอกต้องเป็นตัวเลขเท่านั้น',
                'min' => 'ค่าน้ำประปาต้องมากกว่า 0',
            ],
            'parking_price' => [
                'required' => 'คุณต้องใส่ค่าที่จอดรถ',
                'numeric' => 'ค่าที่จอดรถกรอกต้องเป็นตัวเลขเท่านั้น',
                'min' => 'ค่าที่จอดรถต้องมากกว่า 0',
            ],
            'common_fee' => [
                'required' => 'คุณต้องใส่ค่าส่วนกลาง',
                'numeric' => 'ค่าส่วนกลางกรอกต้องเป็นตัวเลขเท่านั้น',
                'min' => 'ค่าส่วนกลางต้องมากกว่า 0',
            ],
            'damages_price' => [
                'required' => 'คุณต้องใส่ค่าปรับชำระเลยกำหนด',
                'numeric' => 'ค่าปรับชำระเลยกำหนดกรอกต้องเป็นตัวเลขเท่านั้น',
                'min' => 'ค่าปรับชำระเลยกำหนดต้องมากกว่า 0',
            ],
            'deposit' => [
                'required' => 'คุณต้องใส่ค่ามัดจำ',
                'numeric' => 'ค่ามัดจำกรอกต้องเป็นตัวเลขเท่านั้น',
                'min' => 'ค่ามัดจำต้องมากกว่า 0',
            ],
        ];
    }

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}
