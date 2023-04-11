<?php

namespace App\Http\Requests;

use App\Rules\AvailableRoomRule;
use App\Rules\HasRoomRule;
use Illuminate\Foundation\Http\FormRequest;

class BookingCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => 'required',
            'rent_contract' => ['required', 'file', 'mimes:pdf'],
            'room_id' => [new HasRoomRule, new AvailableRoomRule],
            'arrival_date' => ['required', 'date'],
            'deposit' => ['required', 'numeric'],
            'parking_amount' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function attributes(): array
    {
        return [
            'rent_contract' => 'ไฟล์หนังสือสัญญาเช่าห้องพัก',
            'room_id' => 'ห้อง',
            'arrival_date' => 'วันที่จะเข้าพัก',
            'deposit' => 'ค่ามัดจำ',
            'parking_amount' => 'จำนวนที่จอดรถยนต์',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
