<?php

namespace App\Http\Requests;

use App\Rules\AvailableRoomRule;
use App\Rules\HasRoomRule;
use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users',
            'telephone' => 'required|numeric',
            'password' => 'required',
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
            'id_card_copy' => 'required|file|mimes:pdf',
            'copy_house_registration' => 'required|file|mimes:pdf',
            'rent_contract' => 'required|file|mimes:pdf',
            'room_id' => ['required', new HasRoomRule, new AvailableRoomRule],
            'arrival_date' => 'required|date',
            'deposit' => 'required|numeric',
            'parking_amount' => 'required|numeric|min:0',
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => 'อีเมล',
            'telephone' => 'เบอร์โทรศัพท์',
            'password' => 'รหัสผ่าน',
            'id_card' => 'หมายเลขบัตรประชาชน',
            'birthdate' => 'วันเกิด',
            'religion' => 'ศาสนา',
            'name' => 'ชื่อจริง',
            'surname' => 'นามสกุล',
            'address' => 'ที่อยู่',
            'sub_district' => 'ตำบล',
            'district' => 'อำเภอ',
            'province' => 'จังหวัด',
            'postal_code' => 'รหัสไปรษณีย์',
            'id_card_copy' => 'ไฟล์สำเนาบัตรประชาชน',
            'copy_house_registration' => 'ไฟล์สำเนาทะเบียนบ้าน',
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
