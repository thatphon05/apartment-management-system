<?php

namespace App\Http\Requests;

use App\Enums\UserStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UserUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'telephone' => 'required|numeric|max_digits:10',
            'id_card' => 'required|integer|digits:13',
            'birthdate' => 'required|date',
            'religion' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'address' => 'required',
            'sub_district' => 'required',
            'district' => 'required',
            'province' => 'required',
            'postal_code' => 'required|integer|max_digits:5',
            'id_card_copy' => 'file|mimes:pdf',
            'copy_house_registration' => 'file|mimes:pdf',
            'status' => [new Enum(UserStatusEnum::class)],
        ];
    }

    public function attributes(): array
    {
        return [
            'telephone' => 'เบอร์โทรศัพท์',
            'id_card' => 'หมายเลขบัตรประชาชน',
            'birthdate' => 'วันเกิด',
            'religion' => 'ศาสนา',
            'name' => 'ชื่อ',
            'surname' => 'นามสกุล',
            'address' => 'ที่อยู่',
            'sub_district' => 'ตำบล',
            'district' => 'อำเภอ',
            'province' => 'จังหวัด',
            'postal_code' => 'รหัสไปรษณีย์',
            'id_card_copy' => 'ไฟล์สำเนาบัตรประชาชน',
            'copy_house_registration' => 'ไฟล์สำเนาทะเบียนบ้าน',
            'status' => 'สถานะ',
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
